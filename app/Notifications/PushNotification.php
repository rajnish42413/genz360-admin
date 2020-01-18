<?php

namespace App\Notifications;

use App\Channels\Expo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PushNotification extends Notification
{
    use Queueable;

    private $token;
    private $title;
    private $message;

    public function __construct($message,$title=null)
    {
       $this->title = $title;
       $this->message = $message;
    }


    public function via($notifiable)
    {
          return [Expo::class];
    }


   public function toNotification()
    {
        return [
            'data' => [
                'type' => 'Reminders'
            ],
            'title' => $this->title ?? "Genz360",
            'body' => $this->message
        ];
    }


}
