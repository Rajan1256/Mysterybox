<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'google' => [
        'client_id' => '261858933133-q76u2l1tphk8v2dohdb968uufcerdefc.apps.googleusercontent.com',
        'client_secret' => '7CDMYRv7l1Qk55bSAiURJ6XU',
        'redirect' => 'http://localhost/NewProject/callback'],

    'facebook' => [
        'client_id' => '2135212246565051',
        'client_secret' => 'df8ea3525bfe507e874306d6e725e51f',
        'redirect' => 'http://localhost/NewProject/callbackfacebook',
    ],

];
