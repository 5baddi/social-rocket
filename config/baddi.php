<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

return [
    'support_email'     => env('SUPPORT_EMAIL'),
    'help_url'          => env('HELP_URL'),
    'setup_guide'       => env('SETUP_GUIDE'),
    'zendesk_key'       => env('ZENDESK_KEY'),
    'version'           => env('APP_VERSION', '1.0.0'),
    'cache'             => [
        'enabled'       => env('CACHE_FEATURE_ENABLED', false)
    ],
    'hcaptcha'          => [
        'verify_endpoint'           => env('HCAPTCHA_VERIFY_ENDPOINT'),
        'js_endpoint'               => env('HCAPTCHA_JS_ENDPOINT'),
        'secret'                    => env('HCAPTCHA_SECRET'),
        'site_key'                  => env('HCAPTCHA_SITE_KEY'),
        'enabled'                   => env('HCAPTCHA_FEATURE_ENABLED', false),
    ]
];
