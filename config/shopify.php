<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

return [
    'store_oauth_url'   =>  env('SHOPIFY_STORE_OAUTH_URL', 'https://{shop}.myshopify.com/admin/oauth/authorize'),
    'api_key'           =>  env('SHOPIFY_API_KEY'),
];