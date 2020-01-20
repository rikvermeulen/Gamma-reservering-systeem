@extends ('layout')
@section('pageTitle', 'reservation')

@section ('content')

    {{--header--}}
    @include ('layouts.partials.header')
    <main>
        <div class="container">
            <div class="row">
                <form id="" method="post" action="">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </main>

    {{--footer--}}
    @include ('layouts.partials.footer')

@endsection

