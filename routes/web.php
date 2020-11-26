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
    return view('welcome');
});

Auth::routes();

//Social Login
Route::get('/redirect', 'SocialLoginController@redirectToProvider')->name('googleLogin');
Route::get('/callback', 'SocialLoginController@handleProviderCallback');


//Razor PaymentGateway
Route::get('my-store', 'RazorpayController@show_products')->name('paywithrazorpay');
Route::post('pay-success', 'RazorpayController@pay_success');
Route::post('thank-you', 'RazorpayController@thank_you');


Route::get('/home', 'HomeController@index')->name('home');
