
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
    return redirect('/login');
});

Auth::routes();

Route::middleware('web')->group(function () {
  Route::get('/home', 'HomeController@index')->name('home');

  Route::get('/notification-add', 'NotificationController@create');
   Route::get('/user/notification/{token}', 'NotificationController@user');

  Route::post('/user/notify/{token}', 'NotificationController@sendToUser');

  Route::get('/brand/{user}/send', 'NotificationController@infulencerSend');

  Route::post('/notification/send', 'NotificationController@send');

  Route::resource('brands', 'BrandController');
  Route::resource('/influencers', 'InfluencerController');

  Route::resource('campaigns', 'CampaignController');
  Route::get('/campaigns/{camp}/influencers', 'CampaignController@influencer')->name('campaigns.influencer');

  Route::resource('locations', 'LocationController');
  Route::resource('interests', 'InterestController');
});
