@extends ('layout')
@section('pageTitle', 'error?')

@section ('content')

    {{--header--}}
    @include ('layouts.partials.header')
    <main>
        <div class="error">
            404
        </div>
    </main>
    {{--footer--}}
    @include ('layouts.partials.footer')

@endsection
