<?php

namespace App\Channels;

use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Notifications\Notification;

class SMS
{
    private $client;
    public function __construct()
    {
        $this->client = new Client();
    }

    public function setClient($client)
    {
        $this->client = $client;
    }

    public function send($notifiable, $notification)
    {
        if (!$notifiable->phone) {
            return;
        }
        $phone = $notifiable->phone;

        $data = $notification->toMessage($notifiable);

        $payload=[
               'apikey' => "5d3623d8c58fd",
               'mobileno'=> $phone,
               'text'=> $data,
               'sender'=> "GENZZZ",
               'response'=> 'json'
          ];

        try {
            $response = $this->client->post("https://www.smsalert.co.in/api/push.json?apikey=5d3623d8c58fd&sender=GENZZZ&mobileno={$phone}&text={$data}");
         return json_decode((string) $response->getBody());
        } catch (ClientException $e) {
            $response = json_decode((string) $e->getResponse()->getBody());
            throw new \Exception($response->message, $response->code);
        }
    }
}
