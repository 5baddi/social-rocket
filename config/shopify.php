<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

return [
    'store_url'                 =>  env('SHOPIFY_STORE_URL', 'https://{store}.myshopify.com'),
    'store_oauth_url'           =>  env('SHOPIFY_STORE_OAUTH_URL', 'https://{store}.myshopify.com/admin/oauth/authorize'),
    'store_access_token_url'    =>  env('SHOPIFY_STORE_ACCESS_TOKEN_URL', 'https://{store}.myshopify.com/admin/oauth/access_token'),
    'api_key'                   =>  env('SHOPIFY_API_KEY'),
    'client_secret'             =>  env('SHOPIFY_API_SECRET'),
];