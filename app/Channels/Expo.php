<?php

namespace App\Channels;

use GuzzleHttp\Client;
use Illuminate\Notifications\Notification;

class Expo
{

    public function send($notifiable, Notification $notification)
    {
       $token = $notifiable->not_token;
        if (!$token) {
            return;
        }

        $client = new Client();
        $json = array_merge(["to" => $token], $notification->toNotification());
        $response = $client->post("https://exp.host/--/api/v2/push/send", [
            'json' => $json
        ]);
        return (string)$response->getBody();
    }
}