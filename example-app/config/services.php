<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [  
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' =>[
        'client_id' => '372544437148-818kr2udcst5l6e2ouldbuko2rbr932c.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => '/auth/google/callback'
    ],


    'facebook' =>[
        'client_id'=>'2065725140493939',
        'client_secret'=>'509fde74e30b84607610874bebb1f0dc',
        'redirect' =>'/auth/facebook/callback'
    ]

];
    