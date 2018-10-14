<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@show');

Route::get('/home', 'HomeController@show');

Route::get('getService/{service}', 'ServiceController@index')->middleware('subscribed', 'hasEnoughPoints');

Route::get('callback', function () {
    dd("Xxx");
});


Route::get('access1', 'AuthController2@access');
Route::get('test1', 'AuthController2@test');

Route::get('access', 'AuthController@access');
Route::get('test/{invoice_id?}', 'AuthController@test');
