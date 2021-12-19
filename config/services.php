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
    'google' => [
        'client_id'     => "719974631635-b5dldikff3h2hta1244nmuaedh8366c0.apps.googleusercontent.com",
        'client_secret' => "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",
        'redirect'      => "http://localhost:8000/account/social/callback/2",
    ],
    'facebook' => [
        'client_id'     => "434670495045926",
        'client_secret' => "8ef9256d77928467bb5d16f98202e387",
        'redirect'      => "https://localhost:8000/account/social/callback/1",
    ],

];
