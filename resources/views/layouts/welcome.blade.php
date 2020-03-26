@extends ('layout')
@section('pageTitle', 'Gamma')

@section ('content')

    @include ('layouts.partials.header')

    <main class="welcome page">
        <div class="container">
            <div class="welcome-intro">
                    <h1>Verf mengen</h1>
                    <img src="/images/header.webp" alt="">
            </div>
        </div>
            <div class="welcome-info">
                <div class="welcome-info-column">
                    <div class="container">
                        <div class="col-md-6">
                            <div class="content">
                                <h2>Jij kiest de mooiste kleur!</h2>
                                <p>Geen kleur of merk is te gek voor GAMMA! Elke GAMMA bouwmarkt heeft een verfmengmachine, waarmee we meer dan 30.000 kleuren kunnen maken. We mengen verschillende kleuren en mixen merken. Wil je een kleurtje hebben wat niet te koop is in de verfcollectie van GAMMA? Neem dan eens een kijkje bij de grote verfwand of ons online assortiment en laat je gewenste kleur mengen.</p>
                                <a href="/products">Selecteer jou kleur!</a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img src="/images/about1.webp" alt="">
                        </div>
                    </div>
                </div>
                <div class="welcome-info-column">
                    <div class="container">
                        <div class="col-md-12">
                            <img src="/images/about2.webp" alt="">
                        </div>
                    </div>
                </div>
                <div class="welcome-info-column">
                    <div class="container">
                        <div class="col-md-6">
                            <img src="/images/about3.webp" alt="">
                        </div>
                        <div class="col-md-6">
                            <div class="content">
                                <h2>Jij kiest de mooiste kleur!</h2>
                                <p>Elke muur is anders en elk licht is anders. Daarom is het goed om eerst de kleur te testen op je muur. Zo kan je precies zien welke kleur geschikt is voor jouw muur.

                                    Kies en test welke kleur bij jou past!</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="welcome-info-column">
                    <div class="container">
                        <div class="col-md-6">
                            <div class="content">
                                <h2>Tips voor het kiezen van muurverf</h2>
                                <p>Wil je jouw muur in een kleur verven maar weet je niet welke? Lees hier wat de invloed is van bepaalde kleuren in je interieur. Wil je een warme en knusse ruimte creëren? Of ga je liever voor ruimte en rust? Kies de juiste kleuren en creëer precies de sfeer die je zoekt. </p>
                                <a href="https://www.gamma.nl/klusadvies/a/muurkleuren-kiezen">Ga naar kleurtips!</a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img src="/images/about4.webp" alt="">
                        </div>
                    </div>
                </div>
                <div class="welcome-info-column">
                    <div class="container">
                        <div class="col-md-12">
                            <div class="content">
                                <h2>Bekijk de verschillende soorten mengverf</h2>
                                <p>Naast muurverf en lak hebben we diverse soorten verven beschikbaar op de mengmachine. Want je kan bijvoorbeeld magneetverf in je eigen kleur laten mengen. Of schoolbordverf in een bijzondere kleur. Er is een heleboel mogelijk!</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="welcome-info-column">
                    <div class="container">
                        <div class="col-md-6">
                            <img src="/images/about5.webp" alt="">
                        </div>
                        <div class="col-md-6">
                            <div class="content">
                                <h2>Denk ook aan je schildersgereedschap!</h2>
                                <p>Plamuur, vuller, kit, afplakken en schuren. Alles om je schilderklus gemakkelijk te maken. Want hoe beter je bent voorbereidt, hoe makkelijker de schilder klus is. Je kan je schildersgereedschap direct bestellen door naar de schildersbenodigdheden pagina te gaan.</p>
                                <a href=""> Ga naar de schildersbenodigdheden pagina</a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </main>


    {{--footer--}}
    @include ('layouts.partials.footer')


@endsection
