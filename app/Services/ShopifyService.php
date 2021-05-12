<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Str;

class ShopifyService extends Service
{
    /** @var string */
    const SCOPES = "read_orders,read_checkouts,write_price_rules,read_script_tags,write_script_tags";

    /** @var Client */
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://httpbin.org',
            'timeout'  => 2.0,
        ]);
    }

    public function getOAuthURL(string $storeName): string
    {
        $oauthURL = Str::replaceFirst("{store}", $storeName, config('shopify.store_oauth_url'));
        $oauthURL .= "?client_id=" . config('shopify.api_key');
        $oauthURL .= "&scope=" . self::SCOPES;
        $oauthURL .= "&redirect_uri=" . route('oauth.callback');

        return $oauthURL;
    }
}