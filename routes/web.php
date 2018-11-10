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
Route::get('/services/{service}', 'WelcomeController@service');

Route::get('/home', 'HomeController@show');

Route::get('downloadArabicPDF', 'ServiceController@index')->middleware('subscribed', 'points');


Route::get('authorize', 'XeroAuthController@login')->middleware(['auth']);
Route::get('invoice/{invoice_id}', 'InvoiceController@generate')->middleware(['auth', 'points']);


Route::get('/redirect', function (\Illuminate\Http\Request $request) {
    $query = http_build_query([
        'client_id' => $request->client_id,
        'redirect_uri' => $request->redirect_uri,
        'response_type' => 'code',
        'scope' => ''
    ]);

    return redirect('/oauth/authorize?' . $query);
});


Route::get('/callback', function (\Illuminate\Http\Request $request) {
    $http = new GuzzleHttp\Client;

    $response = $http->post(url('oauth/token'), [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => $request->client_id,
            'client_secret' => $request->client_secret,
            'redirect_uri' => $request->redirect_uri,
            'code' => $request->code
        ],
    ]);

    return response(["data" => [
        "auth" => json_decode((string)$response->getBody(), true)
    ]]);
});
