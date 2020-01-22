@component('mail::message')
    # Order Received

    Thank you for your order.

    **Order ID:** {{ $reservation->id }}

    **Order Email:** {{ $reservation->email }}

    *Order Name:** {{ $reservation->name }}

    **Items Ordered**

    {{--@foreach ($order->products as $product)
        Name: {{ $product->name }} <br>
        Price: ${{ round($product->price / 100, 2)}} <br>
        Quantity: {{ $product->pivot->quantity }} <br>
    @endforeach--}}

    You can get further details about your order by logging into our website.

    @component('mail::button', ['url' => config('app.url'), 'color' => 'green'])
        Go to Website
    @endcomponent

    Thank you again for choosing us.

    Regards,<br>
    {{ config('app.name') }}
@endcomponent
