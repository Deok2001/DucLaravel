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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'facebook' => [
        'client_id' => '1507821443073349',
        'client_secret' => '0b1f4b040658339d787cfe398aef7cfd',
        'redirect' => 'http://localhost/shopbanhanglaravel1/admin/callback',
    ],
    'google' => [
        'client_id' => '834087737062-3b97nfmnhtrsjircubk48v7ia2ip9214.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost/shopbanhanglaravel1/google/callback',
    ],
    
];
