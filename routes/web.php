<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.index');
});

Route::get('/products', 'ShopController@index')->name('products.index');
Route::get('/products/{product}', 'ShopController@show')->name('products.show');

Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart/{product}', 'CartController@store')->name('cart.store');
Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');
Route::patch('/cart/{product}', 'CartController@update')->name('cart.update');
Route::post('/cart/switchToSaveForLater/{product}', 'CartController@switchToSaveForLater')->name('cart.switchToSaveForLater');

Route::delete('/saveForLater/{product}', 'SaveForLaterController@destroy')->name('saveForLater.destroy');
Route::post('/saveForLater/switchToCart/{product}', 'SaveForLaterController@switchToCart')->name('saveForLater.switchToCart');

Route::get('/reservation', 'ReservationController@index')->name('reservation.index');
Route::get('/reservation/{product}', 'ReservationController@show')->name('reservation.show');
Route::patch('/reservation/{product}', 'ReservationController@update')->name('reservation.update');
Route::post('/reservation/{id}', 'ReservationController@store')->name('reservation.store');

Route::post('/coupon', 'CouponsController@store')->name('coupon.store');
Route::delete('/coupon', 'CouponsController@destroy')->name('coupon.destroy');

Route::get('/checkout', 'CheckoutController@index')->name('checkout.index')->middleware('auth');
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');
Route::post('/paypal-checkout', 'CheckoutController@paypalCheckout')->name('checkout.paypal');

Route::get('/guestCheckout', 'CheckoutController@index')->name('guestCheckout.index');

Route::get('/thankyou', 'ConfirmationController@index')->name('confirmation.index');

/*Route::get('/product', function () {
    return view('layouts.index');
});*/

Route::middleware('auth')->group(function () {
    Route::get('/my-profile', 'UsersController@edit')->name('users.edit');
    Route::patch('/my-profile', 'UsersController@update')->name('users.update');

    Route::get('/my-orders', 'OrdersController@index')->name('orders.index');
    Route::get('/my-orders/{order}', 'OrdersController@show')->name('orders.show');

    Route::get('/my-reservations', 'ReservationUserController@index')->name('reservations.index');
    Route::get('/my-reservations/{reservation}', 'ReservationUserController@show')->name('reservations.show');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
