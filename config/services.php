<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
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

    'paypal' => [
        'client_id' => 'AZ4Zq9C6drBBcdf4HQkaJ3HdiMwq-UItDVoY37-iXCmizYWtoFYuGqnQKNtVDl4KCsjHmC5st7tww5pd',
        'secret' => 'EHzmDxnjqJ_3cVndTK7GsNixsh9B35JLenJAJeeknnF8-CPX6cQWC9bWDOXbIgD7qzWteBzbQqy-DMy3'
    ],


];
