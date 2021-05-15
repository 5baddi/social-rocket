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
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use BADDIServices\SocialRocket\Models\OAuth;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Exceptions\Shopify\AcceptPaymentFailed;
use BADDIServices\SocialRocket\Exceptions\Shopify\InvalidStoreURLException;
use BADDIServices\SocialRocket\Exceptions\Shopify\InvalidAccessTokenException;
use BADDIServices\SocialRocket\Exceptions\Shopify\CreatePaymentConfirmationFailed;
use BADDIServices\SocialRocket\Exceptions\Shopify\InvalidRequestSignatureException;

class ShopifyService extends Service
{
    /** @var string */
    const SCOPES = "read_orders,read_checkouts,write_price_rules,read_script_tags,write_script_tags";
    const STORE_ENDPOINT = "https://{store}.myshopify.com";
    const OAUTH_AUTHORIZE_ENDPOINT = "/admin/oauth/authorize";
    const OAUTH_ACCESS_TOKEN_ENDPOINT = "/admin/oauth/access_token";
    const RECCURING_CHARGE_ENDPOINT = "/admin/api/2021-04/recurring_application_charges.json";
    const GET_RECCURING_CHARGE_ENDPOINT = "/admin/api/2021-04/recurring_application_charges/{id}.json";

    /** @var Client */
    private $client;

    public function __construct()
    {
        $this->client = new Client([]);
    }

    public function getStoreURL(string $storeName): string
    {
        return (string)Str::replace("{store}", $storeName, self::STORE_ENDPOINT);
    }
    
    public function getOAuthURL(string $storeName): string
    {
        $oauthURL = $this->getStoreURL($storeName);
        $oauthURL .= self::OAUTH_AUTHORIZE_ENDPOINT;
        $oauthURL .= "?client_id=" . config('shopify.api_key');
        $oauthURL .= "&scope=" . self::SCOPES;
        $oauthURL .= "&redirect_uri=" . urlencode(route('oauth.callback'));

        return $oauthURL;
    }

    /**
     * @throws CreatePaymentConfirmationFailed
     */
    public function createRecurringBillingURL(Store $store, array $charge): string
    {
        try {
            $accessToken = $this->hasAccessToken($store);

            $chargeURL = $this->getStoreURL($store->slug);
            $chargeURL .= self::RECCURING_CHARGE_ENDPOINT;

            $requestBody['access_token'] = $accessToken;

            $requestBody['recurring_application_charge'] = $charge;

            $response = $this->client->request('POST', $chargeURL, 
                [
                    'form_params'      => $requestBody,
                    'headers'   => [
                        'Accept'        => 'application/json',
                        'Content-Type'  => 'application/x-www-form-urlencoded',
                    ]
                ]
            );

            $data = json_decode($response->getBody(), true);
            if (!isset($data['recurring_application_charge'], $data['recurring_application_charge']['confirmation_url'])) {
                throw new Exception();
            }

            return $data['recurring_application_charge']['confirmation_url'];
        } catch (Exception | ClientException | RequestException $ex) {
            Log::error($ex->getMessage(), [
                'context'   =>  'store:create-billing',
                'code'      =>  $ex->getCode(),
                'line'      =>  $ex->getLine(),
                'file'      =>  $ex->getFile(),
                'trace'     =>  $ex->getTrace()
            ]);

            throw new CreatePaymentConfirmationFailed();
        }
    }

    /**
     * @throws AcceptPaymentFailed
     */
    public function getBilling(Store $store, string $chargeId): array
    {
        try {
            $accessToken = $this->hasAccessToken($store);

            $chargeURL = $this->getStoreURL($store->slug);
            $chargeURL .= Str::replace("{id}", $chargeId, self::GET_RECCURING_CHARGE_ENDPOINT);
            $chargeURL .= "?access_token={$accessToken}";

            $response = $this->client->request('GET', $chargeURL, 
                [
                    'headers'   => [
                        'Accept'        => 'application/json'
                    ]
                ]
            );

            return json_decode($response->getBody(), true);
        } catch (Exception | ClientException | RequestException $ex) {
            Log::error($ex->getMessage(), [
                'context'   =>  'store:get-billing',
                'code'      =>  $ex->getCode(),
                'line'      =>  $ex->getLine(),
                'file'      =>  $ex->getFile(),
                'trace'     =>  $ex->getTrace()
            ]);

            throw new AcceptPaymentFailed();
        }
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
        
        $storeURL = Str::replace("{store}", $storeURL, self::STORE_ENDPOINT);
        $storeHeaders = @get_headers((string) $storeURL);

        if (!$storeHeaders || $storeHeaders[0] == "HTTP/1.1 404 Not Found") {
            return null;
        }

        return $storeURL;
    }

    public function getStoreAccessToken(array $params): array
    {
        try {
            $this->verifySignature($params);

            $storeName = $this->getStoreName($params['shop']);
            if (is_null($storeName)) {
                throw new InvalidStoreURLException();
            }

            $oauthURL = $this->getStoreURL($storeName);
            $oauthURL .= self::OAUTH_ACCESS_TOKEN_ENDPOINT;

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

            throw new InvalidAccessTokenException();
        }
    }

    public function generateSignature(array $params): string
    {
        return hash_hmac('sha256', http_build_query($params), config('shopify.client_secret'));
    }

    public function verifySignature(array $params): bool
    {
        $hmac = Arr::get($params, 'hmac');
        Arr::forget($params, 'hmac');
        ksort($params);

        $computedHmac = $this->generateSignature($params);
        if (!hash_equals($hmac, $computedHmac)) {
            throw new InvalidRequestSignatureException();
        }

        return true;
    }

    private function hasAccessToken(Store $store): string
    {
        $store->load('oauth');
        if (!$store->oauth instanceof OAuth && !is_null($store->oauth->access_token)) {
            throw new InvalidAccessTokenException();
        }

        return $store->oauth->access_token;
    }
}