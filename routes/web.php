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

Route::get('/', 'HomeController@landing');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'TourController@index')->name('home');
Route::get('/set-banner', 'HomeController@setbanner');
Route::get('/tour/{slug}', 'HomeController@show');
Route::get('/tour/order/{name}', 'HomeController@preorder')->name('pay.preorder');



Route::get('/tour/calculate/send', 'HomeController@calculate');
Route::get('/tour/btn-pay/send', 'HomeController@btnPay');
Route::get('/tour/only-reservation', 'HomeController@onlyReservation');



Route::get('/checkout/thanks', 'MercadoPagoController@thanks')->name('checkout.thanks');
Route::get('/checkout/pending', 'MercadoPagoController@pending')->name('checkout.pending');
Route::get('/checkout/error', 'MercadoPagoController@error')->name('checkout.error');
Route::get('/checkout/only-reservation/{order_id}', 'MercadoPagoController@only_reservation');
Route::get('/checkout/ipn', 'MercadoPagoController@ipn')->name('ipn');



Route::group(['prefix' => 'admin', 'middleware' => 'auth'],   function () {
    Route::resource('tour', 'TourController');
    Route::resource('pickuppoints', 'PickuppointController');
    Route::resource('type-pays', 'TypePayController');
    Route::resource('order', 'OrderController');
});
