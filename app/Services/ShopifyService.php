<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use GuzzleHttp\Exception\ClientException;
use BADDIServices\SocialRocket\Exceptions\Shopify\InvalidStoreURLException;
use BADDIServices\SocialRocket\Exceptions\Shopify\InvalidRequestSignatureException;
use BADDIServices\SocialRocket\Exceptions\Shopify\InvalidAccessTokenResponseException;
use Illuminate\Support\Facades\Log;

class ShopifyService extends Service
{
    /** @var string */
    const SCOPES = "read_orders,read_checkouts,write_price_rules,read_script_tags,write_script_tags";

    /** @var Client */
    private $client;

    public function __construct()
    {
        $this->client = new Client([]);
    }

    public function getOAuthURL(string $storeName): string
    {
        $oauthURL = Str::replace("{store}", $storeName, config('shopify.store_oauth_url'));
        $oauthURL .= "?client_id=" . config('shopify.api_key');
        $oauthURL .= "&scope=" . self::SCOPES;
        $oauthURL .= "&redirect_uri=" . urlencode(route('oauth.callback'));

        return $oauthURL;
    }

    public function getStoreName(string $storeURL): ?string
    {
        if (filter_var($storeURL, FILTER_VALIDATE_URL) !== false || preg_match('/((http|https)\:\/\/)?[a-zA-Z0-9\.\/\?\:@\-_=#]+\.([a-zA-Z0-9\&\.\/\?\:@\-_=#])*/', $storeURL, $match) !== false) {
            if (!Str::startsWith($storeURL, 'http')) {
                $storeURL = Str::start($storeURL, 'https://');
            }

            $parseURL = parse_url($storeURL);
            $storeName = explode('.', $parseURL['host']);

            if (!isset($parseURL['host'], $storeName[0])) {
                return null;
            }

            return $storeName[0];
        }
        
        $storeURL = Str::replace("{store}", $storeURL, config('shopify.store_url'));
        $storeHeaders = @get_headers((string) $storeURL);

        if (!$storeHeaders || $storeHeaders[0] == "HTTP/1.1 404 Not Found") {
            return null;
        }

        return $storeURL;
    }

    public function getStoreAccessToken(array $params): array
    {
        try {
            $this->validateRequest($params);

            $storeName = $this->getStoreName($params['shop']);
            if (is_null($storeName)) {
                throw new InvalidStoreURLException();
            }

            $oauthURL = Str::replace("{store}", $storeName, config('shopify.store_access_token_url'));
            $requestBody = [
                'client_id'                 =>  config('shopify.api_key'),
                'client_secret'             =>  config('shopify.client_secret'),
                'code'                      =>  $params['code']
            ];

            $response = $this->client->request('POST', $oauthURL, 
                [
                    'form_params'      => $requestBody,
                    'headers'   => [
                        'Accept'        => 'application/json',
                        'Content-Type'  => 'application/x-www-form-urlencoded',
                    ]
                ]
            );

            return json_decode($response->getBody(), true);
        } catch (Exception | ClientException $ex) {
            Log::error($ex->getMessage(), [
                'context'   =>  'store:access-token',
                'code'      =>  $ex->getCode(),
                'line'      =>  $ex->getLine(),
                'file'      =>  $ex->getFile(),
                'trace'     =>  $ex->getTrace()
            ]);

            throw new InvalidAccessTokenResponseException();
        }
    }

    private function validateRequest(array $params): bool
    {
        $hmac = Arr::get($params, 'hmac');
        Arr::forget($params, 'hmac');
        ksort($params);

        $computedHmac = hash_hmac('sha256', http_build_query($params), config('shopify.client_secret'));
        if (!hash_equals($hmac, $computedHmac)) {
            throw new InvalidRequestSignatureException();
        }

        return true;
    }
}