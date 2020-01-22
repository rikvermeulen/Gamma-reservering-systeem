<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Mail\ReservationPlaced;
use App\ReservationProduct;
use App\Product;
use App\Reservation;
use App\Mail\OrderPlaced;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.reservation');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationRequest $request)
    {

        /*$category = new Reservation();
        $category->name = $request->name;
        $category->save();*/


        $reservation = $this->addToOrdersTables($request, null);
        Mail::send(new ReservationPlaced($reservation));
        return redirect()->route('confirmation.index')->with('success_message', 'Dank u! U reservering is met succes geplaatst.');

        $this->decreaseQuantities();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id', $id)->firstOrFail();

        $stockLevel = getStockLevel($product->quantity);

        return view('layouts.reservation')->with([
            'product' => $product,
            'stockLevel' => $stockLevel,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between:1,5'
        ]);
        if ($validator->fails()) {
            session()->flash('errors', collect(['Voorraad moet tussen 1 en 5 zijn.']));
            return response()->json(['success' => false], 400);
        }

        if ($request->quantity > $request->productQuantity) {
            session()->flash('errors', collect(['We hebben momenteel niet genoeg producten in voorraad.']));
            return response()->json(['success' => false], 400);
        }


        Cart::update($id, $request->quantity);
        session()->flash('success_message', 'Uw aantal is correct geupdate!');
        return response()->json(['success' => true]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Reservation::remove($id);

        return back()->with('success_message', 'Product is verwijderd');

    }

    protected function addToOrdersTables($request, $error)
    {
        // Insert into orders table
        $reservation = Reservation::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'email' => $request->email,
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'province' => $request->province,
            'postalcode' => $request->postalcode,
            'phone' => $request->phone,
            'error' => $error,
        ]);

        // Insert into order_product table
        ReservationProduct::create([
            'reservation_id' => $reservation->id,
            'product_id' => $request->id,
            'quantity' => $request->quantity,
            'color' => $request->color,
        ]);


        return $reservation;
    }

    protected function productsAreNoLongerAvailable()
    {
        foreach (Reservation::content() as $item) {
            $product = Product::find($item->model->id);
            if ($product->quantity < $item->qty) {
                return true;
            }
        }

        return false;
    }

}
