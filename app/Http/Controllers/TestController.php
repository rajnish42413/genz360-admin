<?php

namespace App\Http\Controllers;
  use \Illuminate\Notifications\Notifiable;
use App\Influencer;
use App\Notifications\PushNotification;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Mail;

class TestController extends Controller
{

    public function index()
    {
    	 $data = [
             "title" => "Tetsing email",
             "body" =>  "Email is notorious for inconsistent CSS support. Therefore you should always inline your CSS before sending.",
             "action" => null
          ];

        Mail::send ( 'mails.test', $data, function ($message) {
              $message->to ("rajnishsingh42413@gmail.com" )->subject ( 'Just Laravel demo email using SendGrid' );
        } );
    }

 
}
