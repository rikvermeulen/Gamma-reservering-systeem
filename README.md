# Gamma reserveringsysteem

Website Demo: http://devenvironment.nl. De demo heeft beperkte rechten. Installeer lokaal voor volledige toegang.

## Installation
1. kloon de repo en gebruik de command `cd` voor het bepalen van de map locatie<br>
2. `composer install`<br>
3. Hernoem of kopieer `.env.example` bestand naar `.env`<br>
4. `php artisan key:generate`<br>
5. Stel uw databasereferenties in uw `.env` bestand in<br>
6. Stel uw Stripe-inloggegevens in uw `.env` bestand in. Concreet `STRIPE_KEY` en `STRIPE_SECRET`<br>
7. Stel uw Braintree-gegevens in uw `.env` bestand als u PayPal wilt gebruiken. Concreet `BT_MERCHANT_ID`, `BT_PUBLIC_KEY` en `BT_PRIVATE_KEY`. Als u dit niet doet, zou het nog steeds moeten werken, maar wordt de PayPal-betaling niet weergegeven bij het afrekenen.<br>
8. Stel uw `APP_URL` in uw `.env` bestand in. Dit is nodig voor Voyager om correct de asset URLs te tonen.<br>
9. tel `ADMIN_PASSWORD` in uw `.env` bestand in als u een beheerderswachtwoord wilt specificeren. Zo niet, dan is het standaardwachtwoord 'password'.<br>
10. `php artisan ecommerce:install`. Hierdoor wordt de database gemigreerd en worden de benodigde seeders uitgevoerd indien nodig. <br>
11. `npm install`<br>
12. `npm run dev`<br>
13. `php artisan serve` of gebruik Laravel Valet, Laravel Homestead of en andere webserver<br>
14. Bezoek `localhost:8000` in uw browser<br>
15. Bezoek `/admin` als u toegang wilt tot de Voyager-beheerders paneel. Admin inlog-gegevens User/Password = `admin@admin.com/password`.<br>
