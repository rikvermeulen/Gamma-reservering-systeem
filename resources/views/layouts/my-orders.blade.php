@extends ('layout')
@section('pageTitle', 'Gamma')

@section ('content')

    @include ('layouts.partials.header')

    <main class="index page">
        <div class="container">
            @if (session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @endif

            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="products-section my-orders container">
            <div class="sidebar">

                <ul>
                    <li><a href="{{ route('users.edit') }}">My Profile</a></li>
                    <li class="active"><a href="{{ route('orders.index') }}">My Orders</a></li>
                </ul>
            </div> <!-- end sidebar -->
            <div class="my-profile">
                <div class="products-header">
                    <h1 class="stylish-heading">My Orders</h1>
                </div>

                <div>
                    @foreach ($orders as $order)
                        <div class="order-container">
                            <div class="order-header">
                                <div class="order-header-items">
                                    <div>
                                        <div class="uppercase font-bold">Order Placed</div>
                                        <div>{{ presentDate($order->created_at) }}</div>
                                    </div>
                                    <div>
                                        <div class="uppercase font-bold">Order ID</div>
                                        <div>{{ $order->id }}</div>
                                    </div><div>
                                        <div class="uppercase font-bold">Total</div>
                                        <div>{{ presentPrice($order->billing_total) }}</div>
                                    </div>
                                </div>
                                <div>
                                    <div class="order-header-items">
                                        <div><a href="{{ route('orders.show', $order->id) }}">Order Details</a></div>
                                        <div>|</div>
                                        <div><a href="#">Invoice</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="order-products">
                                @foreach ($order->products as $product)
                                    <div class="order-product-item">
                                        <div><img src="{{ asset($product->image) }}" alt="Product Image"></div>
                                        <div>
                                            <div>
                                                <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                                            </div>
                                            <div>{{ presentPrice($product->price) }}</div>
                                            <div>Quantity: {{ $product->pivot->quantity }}</div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div> <!-- end order-container -->
                    @endforeach
                </div>

                <div class="spacer"></div>
            </div>
        </div>
    </main>


    {{--footer--}}
    @include ('layouts.partials.footer')


@endsection
