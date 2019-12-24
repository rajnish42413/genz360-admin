<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return [
        'status' => 'ok'
    ];
});


// Route::post('/influencer/{id}/update', "InfluencerController@update");
// Route::get('/influencer/{id}', "InfluencerController@show");