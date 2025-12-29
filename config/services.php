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

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'whatsapp' => [
        'api_url' => env('WHATSAPP_API_URL', 'https://api.fonnte.com/send'),
        'token' => env('WHATSAPP_TOKEN'),
        'enabled' => env('WHATSAPP_ENABLED', true),
    ],

    'pjj_moodle' => [
        'base_url' => env('PJJ_MOODLE_BASE_URL', 'https://pjj.kemenag.go.id/webservice/rest/server.php'),
        'ws_token' => env('PJJ_MOODLE_WS_TOKEN', 'e12b06bf9973df4d0f1bdcf4c31c53d2'),
        'cache_duration' => env('PJJ_MOODLE_CACHE_DURATION', 3600),
    ],

];
