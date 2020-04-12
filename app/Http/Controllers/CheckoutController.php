<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\OrderProduct;
use App\Mail\OrderPlaced;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CheckoutRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Als Cart geen producten bevat keer terug naar product pagina
        if (Cart::instance('default')->count() == 0) {
            return redirect()->route('products.index');
        }

        //Als gebruiker is ingelogt of request is guestcheckout keer naar checkout pagina
        if (auth()->user() && request()->is('guestCheckout')) {
            return redirect()->route('checkout.index');
        }

        //Geeft waardes braintree mee voor betaling
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        //genereert paypal client token voor betaling
        $paypalToken = $gateway->ClientToken()->generate();

        //Geeft waardes mee aan checkout return
        return view('layouts.checkout')->with([
            'paypalToken' => $paypalToken,
            'discount' => getNumbers()->get('discount'),
            'newSubtotal' => getNumbers()->get('newSubtotal'),
            'newTax' => getNumbers()->get('newTax'),
            'newTotal' => getNumbers()->get('newTotal'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {
        // Controleert of product nog op voorraad is tijdens het afrekenen zo niet geef error. functie begint op 264
        if ($this->productsAreNoLongerAvailable()) {
            return back()->withErrors('Sorry! 1 of meer van de geselcteerde producten is niet langer beschikbaar.');
        }

        //Geeft waarde van de content van de cart mee per item met slug en qty via json
        $contents = Cart::content()->map(function ($item) {
            return $item->model->slug . ', ' . $item->qty;
        })->values()->toJson();
        try {
            //maakt betaling aan met de benodigde waardes voor de betaling om betaling te kunnen voltooien en verstuurt deze waardes naar strip
            $charge = Stripe::charges()->create([
                'amount' => getNumbers()->get('newTotal') / 100,
                'currency' => 'EUR',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metadata' => [
                    'contents' => $contents,
                    'quantity' => Cart::instance('default')->count(),
                    'discount' => collect(session()->get('coupon'))->toJson(),
                ],
            ]);

            // als successful
            //voegt de gegevens van de betaling toe aan de order table
            $order = $this->addToOrdersTables($request, null);
            //Verstuurd mail met gegevens van de order
            Mail::send(new OrderPlaced($order));

            // veranderd quantity aan het aantal wat verkocht is van alle product in de cart. functie begint op 255
            $this->decreaseQuantities();

            //verwijderd product uit cart na betaling
            Cart::instance('default')->destroy();

            //verwijderd active coupon tijdens betaling
            session()->forget('coupon');

            //Stuurt na betaling naar succes pagina met succes bericht
            return redirect()->route('confirmation.index')->with('success_message', 'Dank u! Uw betaalmiddel is met succes geaccepteerd.');
        }

        //als betaling niet voltooid is of fout met betaal gegevens  geef error message
        catch (CardErrorException $e) {
            $this->addToOrdersTables($request, $e->getMessage());
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }

    //functie voor het berekenen van de totale prijs van het bedrag met tax en coupon korting
    private function getNumbers()
    {
        $tax = config('cart.tax') / 100;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $newSubtotal = (Cart::subtotal() - $discount);
        if ($newSubtotal < 0) {
            $newSubtotal = 0;
        }
        $newTax = $newSubtotal * $tax;
        $newTotal = $newSubtotal * (1 + $tax);

        return collect([
            'tax' => $tax,
            'discount' => $discount,
            'newSubtotal' => $newSubtotal,
            'newTax' => $newTax,
            'newTotal' => $newTotal,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //functie wat het mogelijk maakt met paypal te betalen via brainthree
    public function paypalCheckout(Request $request)
    {
        // Controleert of product nog op voorraad is tijdens het afrekenen zo niet geef error. functie begint op 264
        if ($this->productsAreNoLongerAvailable()) {
            return back()->withErrors('Sorry! 1 van de items is niet langer beschikbaar.');
        }

        //Geeft waardes mee aan checkout return uit env file van brainthree
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        //Ditis het belangrijk element waarmee uw server gevoelige betalingsinformatie kan communiceren
        $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => round(getNumbers()->get('newTotal') / 100, 2),
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);


        $transaction = $result->transaction;

        //Als gebruiker betaal heeft wordt betalers data verstuurd en data toegevoegd aan order table. Zie table functie op lijn 240
        if ($result->success) {
            $order = $this->addToOrdersTablesPaypal(
                $transaction->paypal['payerEmail'],
                $transaction->paypal['payerFirstName'].' '.$transaction->paypal['payerLastName'],
                null
            );

            //Verstuurd mail met gegevens van de order
            Mail::send(new OrderPlaced($order));

            // // veranderd quantity aan het aantal wat verkocht is van alle product in de cart. functie begint op 255
            $this->decreaseQuantities();

            //verwijderd product uit cart na betaling
            Cart::instance('default')->destroy();

            //verwijderd active coupon tijdens betaling
            session()->forget('coupon');

            //Stuurt na betaling naar succes pagina met succes bericht
            return redirect()->route('confirmation.index')->with('success_message', 'Dank u! Uw betaalmiddel is met succes geaccepteerd.');

        //Als betaling mislukt worden gegevens van de betaler als een fout opgeslagen en wordt het terug gestuurd met een error. Zie tabel op lijn 240
        } else {
            $order = $this->addToOrdersTablesPaypal(
                $transaction->paypal['payerEmail'],
                $transaction->paypal['payerFirstName'].' '.$transaction->paypal['payerLastName'],
                $result->message
            );

            return back()->withErrors('An error occurred with the message: '.$result->message);
        }
    }

    //functie op betaal gegevens, klant gegevens en product gegevens op te slaan als order in db als betaler betaald met credit
    protected function addToOrdersTables($request, $error)
    {
        // Insert into orders table
        $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'billing_email' => $request->email,
            'billing_name' => $request->name,
            'billing_address' => $request->address,
            'billing_city' => $request->city,
            'billing_province' => $request->province,
            'billing_postalcode' => $request->postalcode,
            'billing_phone' => $request->phone,
            'billing_name_on_card' => $request->name_on_card,
            'billing_discount' => getNumbers()->get('discount'),
            'billing_discount_code' => getNumbers()->get('code'),
            'billing_subtotal' => getNumbers()->get('newSubtotal'),
            'billing_tax' => getNumbers()->get('newTax'),
            'billing_total' => getNumbers()->get('newTotal'),
            'error' => $error,
        ]);

        // Insert into order_product table
        foreach (Cart::content() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
            ]);
        }

        return $order;
    }

    //functie op betaal gegevens, klant gegevens en product gegevens op te slaan als order in db als betaler betaald met paypal
    protected function addToOrdersTablesPaypal($email, $name, $error)
    {
        // Insert into orders table
        $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'billing_email' => $email,
            'billing_name' => $name,
            'billing_discount' => getNumbers()->get('discount'),
            'billing_discount_code' => getNumbers()->get('code'),
            'billing_subtotal' => getNumbers()->get('newSubtotal'),
            'billing_tax' => getNumbers()->get('newTax'),
            'billing_total' => getNumbers()->get('newTotal'),
            'error' => $error,
            'payment_gateway' => 'paypal',
        ]);

        // Insert into order_product table
        foreach (Cart::content() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
            ]);
        }

        return $order;
    }

    //functie voor om de voorraad bij te werken na aankoop
    protected function decreaseQuantities()
    {
        //voor elk product in cart vind id product en update quantity aan aantal gekochte producten
        foreach (Cart::content() as $item) {
            $product = Product::find($item->model->id);

            $product->update(['quantity' => $product->quantity - $item->qty]);
        }
    }

    //functie als product niet meer beschikbaar is
    protected function productsAreNoLongerAvailable()
    {
        //voor elk product in cart waar quantity is kleiner dan gevraagd aantal return true
        foreach (Cart::content() as $item) {
            $product = Product::find($item->model->id);
            if ($product->quantity < $item->qty) {
                return true;
            }
        }

        return false;
    }
}
