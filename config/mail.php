<?php

return [

    'driver' => env('MAIL_DRIVER', 'smtp'),
    'host' => env('MAIL_HOST', 'smtp.sendgrid.net'),
    'port' => env('MAIL_PORT', 587),

    'from' => [
        'address' => 'hi@genz360.com',
        'name' => 'Genz360.com',
    ],

    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    
    'username' => "apikey",
    'password' => "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",
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],
    'log_channel' => env('MAIL_LOG_CHANNEL'),

];
