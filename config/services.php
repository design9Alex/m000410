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
        'region' => env('AWS_DEFAULT_REGION', 'ap-east-1'),
    ],

    'google_analytics' => [

        /*
         * The view id of which you want to display data.
         */
        'view_id' => env('ANALYTICS_VIEW_ID'),

        /*
         * Path to the client secret json file. Take a look at the README of this package
         * to learn how to get this file. You can also pass the credentials as an array
         * instead of a file path.
         */
        'service_account_credentials_json' => storage_path('app/analytics/service-account-credentials.json'),

        /*
         * The amount of minutes the Google API responses will be cached.
         * If you set this to zero, the responses won't be cached at all.
         */
        'cache_lifetime_in_minutes' => 10,

        /*
         * Here you may configure the "store" that the underlying Google_Client will
         * use to store it's data.  You may also add extra parameters that will
         * be passed on setCacheConfig (see docs for google-api-php-client).
         *
         * Optional parameters: "lifetime", "prefix"
         */
        'cache' => [
            'store' => 'file',
        ],
    ],

];
