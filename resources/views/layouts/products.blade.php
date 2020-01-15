@extends ('layout')
@section('pageTitle', 'Home')

@section ('content')

    {{--header--}}
    @include ('layouts.partials.header')
    <main>
        <div class="products">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="products-categorie">
                            <h6>categorie</h6>
                            <ul>
                                @foreach ($categories as $category)
                                    <li class="{{ setActiveCategory($category->slug) }}"><a href="{{ route('products.index', ['category' => $category->slug]) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="products-container">
                            <div class="col-md-12">
                                <div class="prodcuts-container-count">
                                    {{--<p>{{App\Product::count() }} resultaten</p>--}}
                                    <div class="products-header">
                                        <h1 class="stylish-heading">{{ $categoryName }}</h1>
                                        <div>
                                            <strong>Price: </strong>
                                            <a href="{{ route('products.index', ['category'=> request()->category, 'sort' => 'low_high']) }}">Low to High</a> |
                                            <a href="{{ route('products.index', ['category'=> request()->category, 'sort' => 'high_low']) }}">High to Low</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @forelse($products as $product)
                            <div class="products-container-tile">
                                <a href="{{ route('products.show', $product->slug) }}">
                                    <img src="{{ Voyager::image($product->image) }}" alt="">
                                </a>
                                <a href="{{ route('products.show', $product->slug) }}">
                                    <div class="products-name">{{ $product->name }}</div>
                                </a>
                                <div class="products-price">
                                    <div class="products-price-info">
                                        <p>{{$product->presentPrice()}}</p>
                                    </div>
                                </div>
                                <form action="{{ route('cart.store', $product->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus icon plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart icon"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                    </button>
                                </form>
                            </div>
                            @empty
                                <div style="text-align: left">No items found</div>
                            @endforelse
                            {{ $products->appends(request()->input())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    {{--footer--}}
    @include ('layouts.partials.footer')

@endsection
