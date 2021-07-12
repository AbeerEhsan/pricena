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
        'client_id' => env('FACEBOOK_CLIENT_ID' , 138524117595943),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET',"1f5aede3859e154f9bb1b973bafd0f0e"),
        'redirect' => env('FACEBOOK_CALLBACK_URL',"https://pricena.dits.cloud/login/facebook/callback"),
    ],
    'twitter' => [
        'client_id' => env('TWITTER_CLIENT_ID' , "8Xg7VMeGWS86OT0AsuY3ljoPs"),
        'client_secret' => env('TWITTER_CLIENT_SECRET',"eSoFUhwDIqucur8z0z9bCYppy0DIK9tpDQ9iBzwS1wymd6UrHy"),
        'redirect' => env('TWITTER_CALLBACK_URL',"https://pricena.dits.cloud/login/twitter/callback"),
    ],
    'google' => [
        'client_id' => env('G_CLIENT_ID' ,"406259984895-6capitrlh8017pmt693mf4rt7dct7u7s.apps.googleusercontent.com"),
        'client_secret' => env('G_CLIENT_SECRET',"N2GM_OoHkr0-GA0bDfiD0dN4"),
        'redirect' => env('G_CALLBACK_URL',"https://pricena.dits.cloud/login/google/callback"),
    ],
];
