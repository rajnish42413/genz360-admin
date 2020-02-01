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


Route::get('influencers', "Api\InfluencerController@index");
Route::get('influencers/{token}', "Api\InfluencerController@show");
Route::post('influencers/applied', "Api\InfluencerController@applied");
Route::post('influencers/update', "Api\InfluencerController@update");
Route::get('influencers/{id}', "Api\InfluencerController@show");

Route::get('campaigns', "Api\CampaignController@index");
Route::get('campaigns/{id}', "Api\CampaignController@show");
Route::get('dailytask/{id}', "Api\CampaignController@dailytaskDetail");
Route::get('influencer/{token}/dailytasks', "Api\CampaignController@dailytask");

