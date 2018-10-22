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


Route::get('authorize', 'XeroAuthController@authorize')->middleware(['auth']);
Route::get('invoice/{invoice_id}', 'InvoiceController@generate')->middleware(['auth', 'points']);
