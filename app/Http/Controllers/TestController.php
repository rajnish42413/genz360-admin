<?php

namespace App\Http\Controllers;
  use \Illuminate\Notifications\Notifiable;
use App\Influencer;
use App\Notifications\PushNotification;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function index()
    {
        $user = Influencer::find(19572);
        $message = "New Order Request for Rajnish Singh";
        $user->notify(new PushNotification($message));
    }

 
}
