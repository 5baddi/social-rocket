<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

return [
    'api_key'                   =>  env('SHOPIFY_API_KEY'),
    'client_secret'             =>  env('SHOPIFY_API_SECRET'),
    'test_enabled'              =>  env('SHOPIFY_API_TEST_ENABLED', false),
];