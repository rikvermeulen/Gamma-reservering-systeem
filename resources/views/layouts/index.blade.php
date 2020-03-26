@extends ('layout')
@section('pageTitle', 'Gamma')

@section ('content')

    @include ('layouts.partials.header')

    <main class="index page">
        <section class="index-intro">
            <div class="container">
                <h1>Dit is een demo versie</h1>
                <p>Klik op de link om de demo versie in te zien</p>
                <a class="" href="/welcome">Reserveren</a>
            </div>
        </section>
    </main>


    {{--footer--}}
    @include ('layouts.partials.footer')


@endsection
