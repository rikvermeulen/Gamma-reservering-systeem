@extends ('layout')
@section('pageTitle', $product->name)

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
            <div class="reservation">
        <div class="container">
            <div class="row">
                <img src="{{ productImage($product->image) }}" alt="product" class="active" id="currentImage" style="width: 20%">
                <div class="container">
                <form action="{{ route('reservation.store', $product) }}" method="POST" id="payment-form">
                    {{ csrf_field() }}
                    <h2>Reservering Details</h2>
                    <p>{{ $product->name }}</p>
                    {{--<p>{{ $product->id }}</p>--}}
                    <div>{!! $stockLevel !!}{{ $product->quantity }}</div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="id" name="id" value="{{ $product->id }}" required>
                        <select id="quantity" name="quantity" class="quantity" data-id="{{ $product->id }}" data-productQuantity="{{ $product->quantity }}">
                            @for ($i = 1; $i < 5 + 1 ; $i++)
                                <option id="quantity" name="quantity" {{ $product->quantity == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-group">
                        @if (auth()->user())
                            <label for="color">Mail</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
                        @else
                            <label for="color">Mail</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="color">Kleur</label>
                        <input class="jscolor" class="form-control" id="color" name="color" value="" required >
                    </div>
                    <div class="form-group">
                        <label for="name">Naam</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Adres</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
                    </div>

                    <div class="half-form">
                        <div class="form-group">
                            <label for="city">Stad</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="province">Provincie</label>
                            <input type="text" class="form-control" id="province" name="province" value="{{ old('province') }}" required>
                        </div>
                    </div> <!-- end half-form -->

                    <div class="half-form">
                        <div class="form-group">
                            <label for="postalcode">Post Code</label>
                            <input type="text" class="form-control" id="postalcode" name="postalcode" value="{{ old('postalcode') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">telefoon nummer</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                        </div>
                    </div> <!-- end half-form -->
                    <div class="form-group">
                        {{--<textarea name="" id="" cols="30" rows="10"></textarea>--}}
                    </div>
                    <button type="submit" id="complete-order" class="button-primary full-width">Complete Order</button>
                </form>

            </div>
            </div>
        </div>
        </div>
    </main>
        <script>
        (function(){
            const classname = document.querySelectorAll('.quantity');
            Array.from(classname).forEach(function(element) {
                element.addEventListener('change', function() {
                    const id = element.getAttribute('data-id');
                    const productQuantity = element.getAttribute('data-productQuantity');

                    axios.patch(`/reservation/${id}`, {
                        quantity: this.value,
                        productQuantity: productQuantity
                    })
                        .then(function (response) {
                            // console.log(response);
                            window.location.href = '{{ route('reservation.show', $product) }}'
                        })
                        .catch(function (error) {
                            // console.log(error);
                            window.location.href = '{{ route('reservation.show', $product) }}'
                        });
                })
            })
        })();
    </script>

    {{--footer--}}
    @include ('layouts.partials.footer')

@endsection

