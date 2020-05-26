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

Route::post('login', 'Api\Auth\UserController@login');
Route::post('register', 'Api\Auth\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
  Route::post('user', 'Api\Auth\UserController@details');
});

Route::get('brands', "Api\BrandController@show");
Route::put('brands', "Api\BrandController@update");
Route::post('brands/storesopc', "Api\BrandController@storeSopc");


Route::get('influencers', "Api\InfluencerController@index");
Route::get('influencers/{token}', "Api\InfluencerController@show");
Route::post('influencers/applied', "Api\InfluencerController@applied");
Route::post('influencers/update', "Api\InfluencerController@update");
Route::get('influencers/{id}', "Api\InfluencerController@show");

Route::get('campaigns', "Api\CampaignController@index");
Route::get('campaigns/{id}', "Api\CampaignController@show");
Route::get('dailytask/{id}', "Api\CampaignController@dailytaskDetail");
Route::get('influencer/{token}/dailytasks', "Api\CampaignController@dailytask");


