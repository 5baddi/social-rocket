<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Str;
use BADDIServices\SocialRocket\Exceptions\Shopify\InvalidStoreURLException;

class ShopifyService extends Service
{
    /** @var string */
    const SCOPES = "read_orders,read_checkouts,write_price_rules,read_script_tags,write_script_tags";

    /** @var Client */
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'timeout'  => 2.0,
        ]);
    }

    public function getOAuthURL(string $storeURL): string
    {
        $storeName = $this->getStoreName($storeURL);
        if (is_null($storeName)) {
            throw new InvalidStoreURLException();
        }

        $oauthURL = Str::replace("{store}", $storeName, config('shopify.store_oauth_url'));
        $oauthURL .= "?client_id=" . config('shopify.api_key');
        $oauthURL .= "&scope=" . self::SCOPES;
        $oauthURL .= "&redirect_uri=" . route('oauth.callback');

        return $oauthURL;
    }

    public function getStoreName(string $storeURL): ?string
    {
        $parseURL = parse_url($storeURL);
        $storeName = explode('.', $parseURL['host']);

        if (!isset($parseURL['host'], $storeName[0])) {
            return null;
        }

        return $storeName[0];
    }

    public function getStoreAccessToken(string $code, string $storeURL): string
    {
        $storeName = $this->getStoreName($storeURL);
        if (is_null($storeName)) {
            throw new InvalidStoreURLException();
        }

        $oauthURL = Str::replace("{store}", $storeName, config('shopify.store_access_token_url'));

        $response = $this->client->request('POST', $oauthURL, [
            'form_params'   => [
                'client_id'                 =>  config('shopify.api_key'),
                'cclient_secretlient_id'    =>  config('shopify.client_secret'),
                'code'                      =>  $code
            ]
        ]);
        return '';
    }
}