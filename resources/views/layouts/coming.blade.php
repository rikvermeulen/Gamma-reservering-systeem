@extends ('layout')
@section('pageTitle', 'error?')

@section ('content')

    {{--header--}}
    @include ('layout.partials.header')
    <main>
        <div class="error">
            <div class="error-title">

            </div>
        </div>
    </main>
    {{--footer--}}
    @include ('layout.partials.footer')

@endsection
