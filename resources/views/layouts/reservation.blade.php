@extends ('layout')
@section('pageTitle', 'reservation')

@section ('content')

    {{--header--}}
    @include ('layouts.partials.header')
    <main>
        <div class="container">
            <div class="row">
                <form id="ClickAndReserveForm" method="post" action="/click-and-reserve/product/517332/store/661"><input type="hidden" name="_csrf" value="31005b32-443b-47b7-8134-c1ff67e8d17a">
                    <fieldset class="mc-fieldset alternative">
                        <div class="form-row">
                            <div class="form-textfield field-quantity form-input--quarter-width">
                                <div class="form-label">
                                    <div class="form-label-label">
                                        <label class="form-label-label-label" for="quantity">Kies een aantal</label>
                                    </div>
                                </div>
                                <div class="form-input">
                                    <div class="form-input-element">
                                        <input data-systemtext-prefix="ClickAndReserveForm.quantity" id="quantity" type="text" name="quantity" autocomplete="off" class="" value="1">
                                        <a class="png-questionmark"></a>
                                        <div class="form-help">Vul een aantal in</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-textvalue field-bouwmarkt">
                                <div class="form-label">
                                    <div class="form-label-label">
                                        <label class="form-label-label-label" for="bouwmarkt"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-textvalue field-akkoordVoorwaardenReserveren">
                                <div class="form-label">
                                    <div class="form-label-label">
                                        <label class="form-label-label-label" for="akkoordVoorwaardenReserveren">Afhalen
                                        </label>
                                    </div>
                                </div>
                                <div class="form-input">
                                    <div class="form-input-element">
                                        <p><a href="https://www.gamma.nl/algemene-voorwaarden/product-reserveren" target="_blank"></a></p></div></div></div></div><div class="form-row"><div class="form-textareafield field-comments"><div class="form-label"><div class="form-label-label"><label class="form-label-label-label" for="comments">Wilt u een opmerking toevoegen?</label></div></div><div class="form-input"><div class="form-textarea-element"><textarea maxlength="256" name="comments" placeholder="Vul hier uw opmerking in" id="comments"></textarea> </div></div></div></div></fieldset><fieldset class="mc-fieldset alternative"><h4>Je gegevens</h4><div class="form-row"><div class="form-label-offset"><div class="form-radiofield field-gender"><div class="form-input"><div class="form-input-element"><input type="radio" value="MALE" autocomplete="false" id="gender1" name="gender" checked="checked"> <label class="form-label" for="gender1"></label></div></div></div><div class="form-radiofield field-gender"><div class="form-input"><div class="form-input-element"><input type="radio" value="FEMALE" autocomplete="false" id="gender2" name="gender"> <label class="form-label" for="gender2"></label></div></div></div></div></div><div class="form-row"><div class="form-textfield field-firstName form-input--half-width"><div class="form-label"><div class="form-label-label"><label class="form-label-label-label" for="firstName">Voornaam</label></div></div><div class="form-input"><div class="form-input-element"><input data-systemtext-prefix="ClickAndReserveForm.firstName" id="firstName" type="text" name="firstName" placeholder="voornaam" autocomplete="off" class="" data-parsley-email-message="Geen geldig e-mailadres" data-parsley-required-message="Dit veld is verplicht" data-parsley-integer-message="Dit is geen geldig nummer" data-parsley-digits-message="Value should be an integer" data-parsley-length-message="Dit veld voldoet niet aan het gewenste aantal tekens" data-parsley-number-message="Dit is geen geldige waarde" data-parsley-type-message="Dit veld is niet correct ingevuld" data-parsley-alphanum-message="Alleen letters en cijfers toegestaan" data-parsley-url-message="form.field.error.url" data-parsley-minlength-message="Minimale aantal tekens is niet bereikt" data-parsley-maxlength-message="Dit veld heeft teveel tekens" data-parsley-min-message="form.field.error.min" data-parsley-max-message="form.field.error.max" data-parsley-loyaltycard-message="Geen geldig Voordeelpasnummer" data-parsley-alphanumdiacritic-message="De karakters <, >, /, \&quot;, =, (, ) zijn niet toegestaan. Gebruik alleen letters en cijfers" value=""> </div></div></div><div class="form-textfield field-middleName form-input--third-width"><div class="form-label"><div class="form-label-label"><label class="form-label-label-label" for="middleName">Tussenv.</label></div></div><div class="form-input"><div class="form-input-element"><input data-systemtext-prefix="ClickAndReserveForm.middleName" id="middleName" type="text" name="middleName" placeholder="tussenvoegsels" autocomplete="off" class="" data-parsley-email-message="Geen geldig e-mailadres" data-parsley-required-message="Dit veld is verplicht" data-parsley-integer-message="Dit is geen geldig nummer" data-parsley-digits-message="Value should be an integer" data-parsley-length-message="Dit veld voldoet niet aan het gewenste aantal tekens" data-parsley-number-message="Dit is geen geldige waarde" data-parsley-type-message="Dit veld is niet correct ingevuld" data-parsley-alphanum-message="Alleen letters en cijfers toegestaan" data-parsley-url-message="form.field.error.url" data-parsley-minlength-message="Minimale aantal tekens is niet bereikt" data-parsley-maxlength-message="Dit veld heeft teveel tekens" data-parsley-min-message="form.field.error.min" data-parsley-max-message="form.field.error.max" data-parsley-loyaltycard-message="Geen geldig Voordeelpasnummer" data-parsley-alphanumdiacritic-message="De karakters <, >, /, \&quot;, =, (, ) zijn niet toegestaan. Gebruik alleen letters en cijfers" value=""> </div></div></div></div><div class="form-row"><div class="form-textfield field-lastName"><div class="form-label"><div class="form-label-label"><label class="form-label-label-label" for="lastName">Achternaam</label></div></div><div class="form-input"><div class="form-input-element"><input data-systemtext-prefix="ClickAndReserveForm.lastName" id="lastName" type="text" name="lastName" placeholder="achternaam" autocomplete="off" class="" data-parsley-email-message="Geen geldig e-mailadres" data-parsley-required-message="Dit veld is verplicht" data-parsley-integer-message="Dit is geen geldig nummer" data-parsley-digits-message="Value should be an integer" data-parsley-length-message="Dit veld voldoet niet aan het gewenste aantal tekens" data-parsley-number-message="Dit is geen geldige waarde" data-parsley-type-message="Dit veld is niet correct ingevuld" data-parsley-alphanum-message="Alleen letters en cijfers toegestaan" data-parsley-url-message="form.field.error.url" data-parsley-minlength-message="Minimale aantal tekens is niet bereikt" data-parsley-maxlength-message="Dit veld heeft teveel tekens" data-parsley-min-message="form.field.error.min" data-parsley-max-message="form.field.error.max" data-parsley-loyaltycard-message="Geen geldig Voordeelpasnummer" data-parsley-alphanumdiacritic-message="De karakters <, >, /, \&quot;, =, (, ) zijn niet toegestaan. Gebruik alleen letters en cijfers" value=""> </div></div></div></div><div class="form-row"><div class="form-textfield field-email"><div class="form-label"><div class="form-label-label"><label class="form-label-label-label" for="email">E-mailadres</label></div></div><div class="form-input"><div class="form-input-element"><input data-systemtext-prefix="ClickAndReserveForm.email" id="email" type="email" name="email" placeholder="e-mailadres" autocomplete="off" class="" data-parsley-email-message="Geen geldig e-mailadres" data-parsley-required-message="Dit veld is verplicht" data-parsley-integer-message="Dit is geen geldig nummer" data-parsley-digits-message="Value should be an integer" data-parsley-length-message="Dit veld voldoet niet aan het gewenste aantal tekens" data-parsley-number-message="Dit is geen geldige waarde" data-parsley-type-message="Dit veld is niet correct ingevuld" data-parsley-alphanum-message="Alleen letters en cijfers toegestaan" data-parsley-url-message="form.field.error.url" data-parsley-minlength-message="Minimale aantal tekens is niet bereikt" data-parsley-maxlength-message="Dit veld heeft teveel tekens" data-parsley-min-message="form.field.error.min" data-parsley-max-message="form.field.error.max" data-parsley-loyaltycard-message="Geen geldig Voordeelpasnummer" data-parsley-alphanumdiacritic-message="De karakters <, >, /, \&quot;, =, (, ) zijn niet toegestaan. Gebruik alleen letters en cijfers" value=""> </div></div></div></div><div class="form-row"><div class="form-textfield field-phone"><div class="form-label"><div class="form-label-label"><label class="form-label-label-label" for="phone">Telefoonnummer</label></div></div><div class="form-input"><div class="form-input-element"><input data-systemtext-prefix="ClickAndReserveForm.phone" id="phone" type="text" name="phone" placeholder="telefoonnummer" autocomplete="off" class="" data-parsley-email-message="Geen geldig e-mailadres" data-parsley-required-message="Dit veld is verplicht" data-parsley-integer-message="Dit is geen geldig nummer" data-parsley-digits-message="Value should be an integer" data-parsley-length-message="Dit veld voldoet niet aan het gewenste aantal tekens" data-parsley-number-message="Dit is geen geldige waarde" data-parsley-type-message="Dit veld is niet correct ingevuld" data-parsley-alphanum-message="Alleen letters en cijfers toegestaan" data-parsley-url-message="form.field.error.url" data-parsley-minlength-message="Minimale aantal tekens is niet bereikt" data-parsley-maxlength-message="Dit veld heeft teveel tekens" data-parsley-min-message="form.field.error.min" data-parsley-max-message="form.field.error.max" data-parsley-loyaltycard-message="Geen geldig Voordeelpasnummer" data-parsley-alphanumdiacritic-message="De karakters <, >, /, \&quot;, =, (, ) zijn niet toegestaan. Gebruik alleen letters en cijfers" value=""> </div></div></div></div></fieldset><div class="form-options alternative"><input type="submit" class="button--orange" value="verstuur reservering"> <a href="https://www.gamma.nl/p/517332" class="arrow-back">annuleren</a></div></form>
            </div>
        </div>
    </main>

    {{--footer--}}
    @include ('layouts.partials.footer')

@endsection

