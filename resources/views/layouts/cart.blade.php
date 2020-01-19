@extends ('layout')
@section('pageTitle', 'Gamma')

@section ('content')

    {{--header--}}
    @include ('layouts.partials.header')
    <main>
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

        @if (Cart::count() > 0)

        <h2>{{ Cart::count() }} item(s) in Shopping Cart</h2>

            @foreach(Cart::content() as $item)
                    <div class="cart-table-row">
                        <a href="{{ route('products.show', $item->model->slug) }}">
                            <img src="{{ productImage($item->model->image) }}" alt="">
                        </a>
                        <div class="cart-item-details">
                            <div class="cart-table-item"><a href="{{ route('products.show', $item->model->slug) }}">{{ $item->model->name }}</a></div>
                            <div class="cart-table-description">{!! $item->model->details !!}</div>
                            <div class="price">
                                <select class="quantity" data-id="{{ $item->rowId }}" data-productQuantity="{{ $item->model->quantity }}">
                                @for ($i = 1; $i < 5 + 1 ; $i++)
                                        <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                <div>{{ presentPrice($item->subtotal) }}</div>
                                @if (! session()->has('coupon'))

                                    <a href="#" class="have-code">Have a Code?</a>

                                    <div class="have-code-container">
                                        <form action="{{ route('coupon.store') }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="text" name="coupon_code" id="coupon_code">
                                            <button type="submit" class="button button-plain">Apply</button>
                                        </form>
                                    </div> <!-- end have-code-container -->
                                @endif
                            </div>
                            <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="cart-options">Remove</button>
                            </form>
                            <form action="{{ route('cart.switchToSaveForLater', $item->rowId) }}" method="POST">
                                {{ csrf_field() }}
                                <button type="submit" class="cart-options">save for later</button>
                            </form>
                        </div>
                    </div>

                @endforeach

                @if (session()->has('coupon'))
                    Code ({{ session()->get('coupon')['name'] }})
                    <form action="{{ route('coupon.destroy') }}" method="POST" style="display:block">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" style="font-size:14px;">Remove</button>
                    </form>
                    <hr>
                    New Subtotal <br>
                @endif
                Tax ({{config('cart.tax')}}%)<br>
                <span class="cart-totals-total">Total</span>
                <div class="cart-totals-subtotal">
                    {{ presentPrice(Cart::subtotal()) }} <br>
                    @if (session()->has('coupon'))
                        -{{ presentPrice($discount) }} <br>&nbsp;<br>
                        <hr>
                        {{ presentPrice($newSubtotal) }} <br>
                    @endif
                    {{ presentPrice($newTax) }} <br>
                    <span class="cart-totals-total">{{ presentPrice($newTotal) }}</span>
                </div>

                <a href="{{ route('checkout.index') }}" class="button-primary">Proceed to Checkout</a>

            @else

                <h3>No items in Cart!</h3>
                <a href="{{ route('products.index') }}" class="button">Continue Shopping</a>

            @endif

            @if (Cart::instance('saveForLater')->count() > 0)

                <h2>{{ Cart::instance('saveForLater')->count() }} item(s) Saved For Later</h2>

                <div class="saved-for-later cart-table">
                    @foreach (Cart::instance('saveForLater')->content() as $item)
                        <div class="cart-table-row">
                            <div class="cart-table-row-left">
                                <a href="{{ route('products.show', $item->model->slug) }}"><img src="{{ asset('images/'.$item->model->slug.'.jpg') }}" alt="item" class="cart-table-img"></a>
                                <div class="cart-item-details">
                                    <div class="cart-table-item"><a href="{{ route('products.show', $item->model->slug) }}">{{ $item->model->name }}</a></div>
                                    <div class="cart-table-description">{{ $item->model->details }}</div>
                                </div>
                            </div>
                            <div class="cart-table-row-right">
                                <div class="cart-table-actions">
                                    <form action="{{ route('saveForLater.destroy', $item->rowId) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" class="cart-options">Remove</button>
                                    </form>

                                    <form action="{{ route('saveForLater.switchToCart', $item->rowId) }}" method="POST">
                                        {{ csrf_field() }}

                                        <button type="submit" class="cart-options">Move to Cart</button>
                                    </form>
                                </div>

                                <div>{{ $item->model->presentPrice() }}</div>
                            </div>
                        </div> <!-- end cart-table-row -->
                    @endforeach

                </div> <!-- end saved-for-later -->
                @endif


    </main>

    <script>
        (function(){
            const classname = document.querySelectorAll('.quantity');
            Array.from(classname).forEach(function(element) {
                element.addEventListener('change', function() {
                    const id = element.getAttribute('data-id');
                    const productQuantity = element.getAttribute('data-productQuantity');

                    axios.patch(`/cart/${id}`, {
                        quantity: this.value,
                        productQuantity: productQuantity
                    })
                        .then(function (response) {
                            // console.log(response);
                            window.location.href = '{{ route('cart.index') }}'
                        })
                        .catch(function (error) {
                            // console.log(error);
                            window.location.href = '{{ route('cart.index') }}'
                        });
                })
            })
        })();
    </script>

    {{--footer--}}
    @include ('layouts.partials.footer')

@endsection

