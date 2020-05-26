<?php

namespace App\Notifications;

use App\Channels\SMS;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class OTPVerification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $otp;
    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function via($notifiable)
    {
        return [SMS::class];
    }

    public function toMessage()
    {
        return "You OTP for Login/Signup at GenZ360 is {$this->otp}.Please Note this is valid only for 2 minutes.";
    }
}
