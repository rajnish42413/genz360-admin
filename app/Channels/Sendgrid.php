<?php

namespace App\Channels;

use SendGrid as SendGridService;
use SendGrid\Mail\Mail;
use Illuminate\Notifications\Notification;
use App\Email;

class Sendgrid
{

    public function send($notifiable, Notification $notification)
    {
        $to = $notifiable;
        $tplId = $notification->template;

        if (!$tplId) {
            throw new \Exception('Invalid template id');
        }
        
        $data = $notification->toArray($notifiable);
        $email = new Mail();
        $email->setTemplateId($tplId);
        $email->addDynamicTemplateDatas($data);
        $email->setFrom(config('mail.from.address'), config('mail.from.name'));
        $email->addTo($to->email, $to->name);
        if (isset($notification->cc)) {
            $_cc = $notification->cc;
            $email->addCc($_cc[0], $_cc[1]);
        } else {
            $email->addCc(config('mail.from.address'), config('mail.from.name'));
        }
        if ($cc = $to->data()->where('name', 'cc_email')->value('value')) {
            foreach (explode(',', $cc) as $c) {
                $c = trim($c);
                if (!$c) continue;
                $email->addCc($c);
            }
        }
        try {
            $sendgrid = new SendGridService(config('services.sendgrid.key'));
            return $this->handleEmailNotifyResponse(
                $sendgrid->send($email),
                $to->email
            );
        } catch (\Exception $e) {
            if (\App::environment('local')) {
                throw $e;
            }
            return Email::create([
                'status' => 'failed',
                'email' => $to->email,
                'message' => $e->getMessage()
            ]);
        }
    }

    private function handleEmailNotifyResponse($response, $email)
    {
        $body = json_decode($response->body());
        if ($response->statusCode() !== 202) {
            return Email::create([
                'status' => 'failed',
                'email' => $email,
                'message' => $body->errors[0]->message ?? ''
            ]);
        }

        return Email::create([
            'status' => 'sent',
            'email' => $email,
            'message_id' => $response->headers(true)['X-Message-Id']
        ]);
    }
}
