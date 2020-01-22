@extends ('layout')
@section('pageTitle', $product->name)

@section ('content')

    {{--header--}}
    @include ('layouts.partials.header')
    <main>
        <div class="container">
            <div class="row">
                <div class="col12 col-md-6">
                    <div class="product-section-image">
                        <img src="{{ productImage($product->image) }}" alt="product" class="active" id="currentImage">
                    </div>
                    <div class="product-section-images">
                        <div class="product-section-thumbnail selected">
                            <img src="{{ productImage($product->image) }}" alt="product">
                        </div>
                        @if ($product->images)
                            @foreach (json_decode($product->images, true) as $image)
                                <div class="product-section-thumbnail">
                                    <img src="{{ productImage($image) }}" alt="product">
                                </div>
                            @endforeach
                        @endif
                    </div>

                </div>
                <div class="col12 col-md-6">
                    <a href="{{ route('products.show', $product->slug) }}"><div>{{ $product->name }}</div></a>
                    <div>{{$product->presentPrice()}}</div>
                    <div class="cart">
                        {{--@if ($product->quantity > 0)--}}
                        @if ($product->quantity > 0)
                            <form action="{{ route('cart.store', $product) }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="hidden" name="name" value="{{ $product->name }}">
                                <input type="hidden" name="price" value="{{ $product->price }}">
                                <button type="submit" class="btn btn-primary button button-plain">Winkelmandje</button>
                            </form>
                        @endif
                           {{-- <form action="{{ route('reservation.store', $product) }}" method="POST">
                                {{csrf_field()}}
                                <button type="submit" class="button button-plain">reservation</button>
                            </form>--}}
                        @if ($product->quantity > 0)
                        <a class="btn btn-secondary" href="{{ route('reservation.show', $product) }}"><div>reserveren</div></a>
                            @endif
                        {{--@endif--}}
                    </div>
                </div>
                <div class="col12 col-md-12">
                    <div>{!! $product->details !!}</div>
                    <div>{!! $stockLevel !!}</div>
                    <p>{!! $product->discription !!}</p>
                </div>
            </div>
        </div>
    </main>

    <script>
        (function(){
            const currentImage = document.querySelector('#currentImage');
            const images = document.querySelectorAll('.product-section-thumbnail');
            images.forEach((element) => element.addEventListener('click', thumbnailClick));
            function thumbnailClick(e) {
                currentImage.classList.remove('active');
                currentImage.addEventListener('transitionend', () => {
                    currentImage.src = this.querySelector('img').src;
                    currentImage.classList.add('active');
                })
                images.forEach((element) => element.classList.remove('selected'));
                this.classList.add('selected');
            }
        })();
    </script>


    {{--footer--}}
    @include ('layouts.partials.footer')

@endsection
