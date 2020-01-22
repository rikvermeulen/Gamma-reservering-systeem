@extends ('layout')
@section('pageTitle', 'thx')

@section ('content')

    {{--header--}}
    @include ('layouts.partials.header')
    <main>
        <div class="reservation">
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
                <h1 style="text-align: center">Dank u voor uw aankoop</h1>
                <a style="text-align: center" href="/">Ga terug</a>
            </div>
        </div>
    {{--footer--}}
    @include ('layouts.partials.footer')

@endsection
