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

Route::get('downloadArabicPDF', 'ServiceController@index')->middleware('subscribed', 'points');


Route::get('access1', 'XeroTestController@access');
Route::get('authorize', 'XeroTestController@test');
Route::get('invoice', 'XeroTestController@invoice');

Route::get('access', 'AuthController@access');
Route::get('test/{invoice_id?}', 'AuthController@test')->middleware('points');
