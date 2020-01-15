@extends ('layout')
@section('pageTitle', 'error?')

@section ('content')

    {{--header--}}
    @include ('layout.partials.header')
    <main>
        <div class="error">

        </div>
    </main>
    {{--footer--}}
    @include ('layout.partials.footer')

@endsection
