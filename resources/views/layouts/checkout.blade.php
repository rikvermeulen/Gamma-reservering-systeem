@extends ('layout')
@section('pageTitle', 'Gamma')

@section ('content')

    {{--header--}}
    @include ('layouts.partials.header')
    <style>
        .StripeElement {
            background-color: white;
            padding: 16px 16px;
            border: 1px solid #ccc;

        }

        .StripeElement--focus {
        // box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }

        #card-errors {
            color: #fa755a;
        }
    </style>
    <main>
        <div class="container">

            @if (session()->has('success_message'))
                <div class="spacer"></div>
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @endif

            @if(count($errors) > 0)
                <div class="spacer"></div>
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h1 class="checkout-heading stylish-heading">Checkout</h1>
            <div class="checkout-section">
                <div>
                    <form action="{{ route('checkout.store') }}" method="POST" id="payment-form">
                        {{ csrf_field() }}
                        <h2>Billing Details</h2>

                        <div class="form-group">
                            @if (auth()->user())
                                <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
                            @else
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
                        </div>

                        <div class="half-form">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="province">Province</label>
                                <input type="text" class="form-control" id="province" name="province" value="{{ old('province') }}" required>
                            </div>
                        </div> <!-- end half-form -->

                        <div class="half-form">
                            <div class="form-group">
                                <label for="postalcode">Postal Code</label>
                                <input type="text" class="form-control" id="postalcode" name="postalcode" value="{{ old('postalcode') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                            </div>
                        </div> <!-- end half-form -->
                        <label for="name_on_card">Name on Card</label>
                        <input type="text" class="form-control" id="name_on_card" name="name_on_card" value="">

                <div class="form-group">
                    <input type="text" class="form-control" id="expiry" name="expiry" placeholder="MM/DD">
                    <label for="card-element">
                        Credit or debit card
                    </label>
                    <div id="card-element">
                        <!-- a Stripe Element will be inserted here. -->
                    </div>
                    <!-- Used to display form errors -->
                    <div id="card-errors" role="alert"></div>
                </div>
                <div class="spacer"></div>
                <button type="submit" id="complete-order" class="button-primary full-width">Complete Order</button>


                </form>
                <h2>Your Order</h2>

                <div class="checkout-table">
                    @foreach (Cart::content() as $item)
                        <div class="checkout-table-row">
                            <div class="checkout-table-row-left">
                                <img src="{{ productImage($item->model->image) }}" alt="">
                                <div class="checkout-item-details">
                                    <div class="checkout-table-item">{{ $item->model->name }}</div>
                                    <div class="checkout-table-description">{!! $item->model->details !!}</div>
                                    <div class="checkout-table-price">{{ $item->model->presentPrice() }}</div>
                                </div>
                            </div> <!-- end checkout-table -->

                            <div class="checkout-table-row-right">
                                <div class="checkout-table-quantity">{{ $item->qty }}</div>
                            </div>
                        </div> <!-- end checkout-table-row -->
        @endforeach
                </div> <!-- end checkout-table -->

                <div class="checkout-totals">
                    <div class="checkout-totals-left">
                        Subtotal <br>
                        Tax ({{config('cart.tax')}}%)<br>
                        @if (session()->has('coupon'))
                            Discount ({{ session()->get('coupon')['name'] }}) :
                            <br>
                            <hr>
                        @endif
                        <div class="checkout-totals-right">
                            {{ presentPrice(Cart::subtotal()) }} <br>
                            @if (session()->has('coupon'))
                                -{{ presentPrice($discount) }} <br>
                                <hr>
                                {{ presentPrice($newSubtotal) }} <br>
                            @endif
                            {{ presentPrice($newTax) }} <br>
                            <span class="checkout-totals-total">{{ presentPrice($newTotal) }}</span>
                        </div>
                    </div>
                </div> <!-- end checkout-totals -->
            </div>
        </div>
        </div>

    </main>
    <script>
        (function(){
            // Create a Stripe client
            var stripe = Stripe('pk_test_ue6MOR1DyErULFJOz9tqTZjf00xB4mDOzX');
            // Create an instance of Elements
            var elements = stripe.elements();
            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
                base: {
                    color: '#32325d',
                    lineHeight: '18px',
                    fontFamily: '"Roboto", Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };
            // Create an instance of the card Element
            var card = elements.create('card', {
                style: style,
                hidePostalCode: true
            });
            // Add an instance of the card Element into the `card-element` <div>
            card.mount('#card-element');
            // Handle real-time validation errors from the card Element.
            card.addEventListener('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });
            // Handle form submission
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                // Disable the submit button to prevent repeated clicks
                document.getElementById('complete-order').disabled = true;
                var options = {
                    name: document.getElementById('name_on_card').value,
                    address_line1: document.getElementById('address').value,
                    address_city: document.getElementById('city').value,
                    address_state: document.getElementById('province').value,
                    address_zip: document.getElementById('postalcode').value
                }
                stripe.createToken(card, options).then(function(result) {
                    if (result.error) {
                        // Inform the user if there was an error
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                        // Enable the submit button
                        document.getElementById('complete-order').disabled = false;
                    } else {
                        // Send the token to your server
                        stripeTokenHandler(result.token);
                    }
                });
            });
            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
                // Submit the form
                form.submit();
            }
        })();
    </script>

    {{--footer--}}
    @include ('layouts.partials.footer')

@endsection

