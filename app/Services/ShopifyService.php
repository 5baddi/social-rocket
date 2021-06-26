<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use Exception;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use BADDIServices\SocialRocket\AppLogger;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use BADDIServices\SocialRocket\Models\Pack;
use BADDIServices\SocialRocket\Models\OAuth;
use BADDIServices\SocialRocket\Models\Store;
use Symfony\Component\HttpFoundation\Response;
use BADDIServices\SocialRocket\Exceptions\Shopify\OrderNotFound;
use BADDIServices\SocialRocket\Exceptions\Shopify\ProductNotFound;
use BADDIServices\SocialRocket\Exceptions\Shopify\CustomerNotFound;
use BADDIServices\SocialRocket\Exceptions\Shopify\AcceptPaymentFailed;
use BADDIServices\SocialRocket\Exceptions\Shopify\CreateDiscountFailed;
use BADDIServices\SocialRocket\Exceptions\Shopify\FetchResourcesFailed;
use BADDIServices\SocialRocket\Exceptions\Shopify\CreatePriceRuleFailed;
use BADDIServices\SocialRocket\Exceptions\Shopify\CancelSubscriptionFailed;
use BADDIServices\SocialRocket\Exceptions\Shopify\InvalidStoreURLException;
use BADDIServices\SocialRocket\Exceptions\Shopify\LoadConfigurationsFailed;
use BADDIServices\SocialRocket\Exceptions\Shopify\InvalidAccessTokenException;
use BADDIServices\SocialRocket\Exceptions\Shopify\IntegateAppLayoutToThemeFailed;
use BADDIServices\SocialRocket\Exceptions\Shopify\CreatePaymentConfirmationFailed;
use BADDIServices\SocialRocket\Exceptions\Shopify\InvalidRequestSignatureException;

class ShopifyService extends Service
{
    /** @var string */
    const SCOPES = "read_orders,read_customers,read_products,read_checkouts,read_price_rules,write_price_rules,read_discounts,write_discounts,read_script_tags,write_script_tags";
    const STORE_ENDPOINT = "https://{store}.myshopify.com";
    const STORE_CONFIGS_ENDPOINT = "/admin/api/2021-04/shop.json";
    const PRODUCT_ENDPOINT = "/products/{slug}";
    const OAUTH_AUTHORIZE_ENDPOINT = "/admin/oauth/authorize";
    const OAUTH_ACCESS_TOKEN_ENDPOINT = "/admin/oauth/access_token";
    const RECCURING_CHARGE_ENDPOINT = "/admin/api/2021-04/recurring_application_charges.json";
    const USAGE_CHARGE_ENDPOINT = "/admin/api/2021-04/recurring_application_charges/{id}/usage_charges.json";
    const GET_RECCURING_CHARGE_ENDPOINT = "/admin/api/2021-04/recurring_application_charges/{id}.json";
    const GET_USAGE_CHARGE_ENDPOINT = "/admin/api/2021-04/recurring_application_charges/{charge_id}/usage_charges/{usage_id}.json";
    const DELETE_CHARGE_ENDPOINT = "/admin/api/2021-04/recurring_application_charges/{id}.json";
    const POST_SCRIPT_TAG_ENDPOINT = "/admin/api/2021-04/script_tags.json";
    const POST_PRICE_RULE_ENDPOINT = "/admin/api/2021-04/price_rules.json";
    const POST_DISCOUNT_ENDPOINT = "/admin/api/2021-04/price_rules/{id}/discount_codes.json";
    const GET_CUSTOMER_ENDPOINT = "/admin/api/2021-04/customers/{id}.json";
    const GET_PRODUCT_ENDPOINT = "/admin/api/2021-04/products/{id}.json";
    const GET_ORDER_ENDPOINT = "/admin/api/2021-04/orders/{id}.json?fields=id,currency,name,total_price,confirmed,total_discounts,total_price_usd,discount_codes,checkout_id,customer,line_items,created_at";
    const GET_ORDERS_ENDPOINT = "/admin/api/2021-04/orders.json?fields=id,currency,name,total_price,confirmed,total_discounts,total_price_usd,discount_codes,checkout_id,customer,line_items,created_at";

    /** @var Client */
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'debug'         => false,
            'http_errors'   => false,
        ]);
    }

    public function getStoreURL(string $storeName): string
    {
        return (string)Str::replace("{store}", $storeName, self::STORE_ENDPOINT);
    }

    public function getProductURL($store, string $slug): string
    {
        $productURL = $this->getStoreURL($store->slug);
        $productURL .= Str::replace("{slug}", $slug, self::PRODUCT_ENDPOINT);

        return $productURL;
    }
    
    public function getProductWithDiscountURL($store, string $slug, string $coupon): string
    {
        $productURL = $this->getStoreURL($store->slug);
        $productURL .= "/discount/{$coupon}?redirect=";
        $productURL .= Str::replace("{slug}", $slug, self::PRODUCT_ENDPOINT);

        return $productURL;
    }
    
    public function getOAuthURL(Store $store): string
    {
        $oauthURL = $this->getStoreURL($store->slug);
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
            $billingApplication = $this->createBillingChargeApplication($store, $charge);

            if (!isset($billingApplication['recurring_application_charge'], $billingApplication['recurring_application_charge']['confirmation_url'])) {
                throw new Exception();
            }

            return $billingApplication['recurring_application_charge']['confirmation_url'];
        } catch (Exception | ClientException | RequestException $ex) {
            Log::error($ex->getMessage(), [
                'context'   =>  'store:create-reccuring-billing',
                'code'      =>  $ex->getCode(),
                'line'      =>  $ex->getLine(),
                'file'      =>  $ex->getFile(),
                'trace'     =>  $ex->getTrace()
            ]);

            throw new CreatePaymentConfirmationFailed();
        }
    }

    /**
     * @throws LoadConfigurationsFailed
     */
    public function loadConfigurations(Store $store): array
    {
        try {
            $accessToken = $this->hasAccessToken($store);

            $configURL = $this->getStoreURL($store->slug);
            $configURL .= self::STORE_CONFIGS_ENDPOINT;
            $configURL .= "?access_token={$accessToken}";

            $response = $this->client->request('GET', $configURL, 
                [
                    'headers'   => [
                        'Accept'        => 'application/json',
                    ]
                ]
            );

            $data = json_decode($response->getBody(), true);

            if (!isset($data['shop'])) {
                throw new Exception();
            }

            return $data['shop'];
        } catch (Exception | ClientException | RequestException $e) {
            AppLogger::setStore($store)->error($e, 'store:load-configurations');

            throw new LoadConfigurationsFailed();
        }
    }
    
    /**
     * @throws AcceptPaymentFailed
     */
    public function getUsageBilling(Store $store, Pack $pack, string $chargeId): array
    {
        try {
            $accessToken = $this->hasAccessToken($store);

            $chargeURL = $this->getStoreURL($store->slug);
            $chargeURL .= Str::replace("{id}", $chargeId, self::USAGE_CHARGE_ENDPOINT);

            $requestBody['access_token'] = $accessToken;

            $requestBody['recurring_application_charge_id'] = $chargeId;
            $requestBody['usage_charge'] = [
                'description'   => $pack->price . '% of revenue share',
                'price'         => 1.0
            ];

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
            if (!isset($data['usage_charge'], $data['usage_charge']['id'])) {
                throw new Exception();
            }

            return $this->getBilling($store, $chargeId, $data['usage_charge']['id']);
        } catch (Exception | ClientException | RequestException $e) {
            AppLogger::setStore($store)->error($e, 'store:get-usage-billing');

            throw new AcceptPaymentFailed();
        }
    }

    /**
     * @throws AcceptPaymentFailed
     */
    public function getBilling(Store $store, string $chargeId, string $usageId = null): array
    {
        try {
            $accessToken = $this->hasAccessToken($store);

            $chargeURL = $this->getStoreURL($store->slug);
            if ($usageId !== null) {
                $chargeURL .= Str::replace(['{charge_id}', '{usage_id}'], [$chargeId, $usageId], self::GET_USAGE_CHARGE_ENDPOINT);
            } else {
                $chargeURL .= Str::replace('{charge_id}', $chargeId, self::GET_RECCURING_CHARGE_ENDPOINT);
            }

            $chargeURL .= "?access_token={$accessToken}";

            $response = $this->client->request('GET', $chargeURL, 
                [
                    'headers'   => [
                        'Accept'        => 'application/json'
                    ]
                ]
            );

            $data = json_decode($response->getBody(), true);
            if (!isset($data['recurring_application_charge']) && !isset($data['usage_charge'])) {
                throw new Exception();
            }

            return $usageId !== null ? $data['usage_charge'] : $data['recurring_application_charge'];
        } catch (Exception | ClientException | RequestException $e) {
            AppLogger::setStore($store)->error($e, 'store:get-charge-billing');

            throw new AcceptPaymentFailed();
        }
    }
    
    /**
     * @throws CustomerNotFound
     */
    public function getCustomer(Store $store, string $customerId): array
    {
        try {
            $accessToken = $this->hasAccessToken($store);

            $customerURL = $this->getStoreURL($store->slug);
            $customerURL .= Str::replace("{id}", $customerId, self::GET_CUSTOMER_ENDPOINT);
            $customerURL .= "?access_token={$accessToken}";

            $response = $this->client->request('GET', $customerURL, 
                [
                    'headers'   => [
                        'Accept'        => 'application/json'
                    ]
                ]
            );

            $data = json_decode($response->getBody(), true);

            if (!isset($data['customer']) || $response->getStatusCode() !== Response::HTTP_OK) {
                throw new CustomerNotFound();
            }

            return $data['customer'];
        } catch (Exception | ClientException | RequestException $ex) {
            Log::error($ex->getMessage(), [
                'context'   =>  'store:get-customer',
                'code'      =>  $ex->getCode(),
                'line'      =>  $ex->getLine(),
                'file'      =>  $ex->getFile(),
                'trace'     =>  $ex->getTrace()
            ]);

            throw new CustomerNotFound();
        }
    }
    
    /**
     * @throws OrderNotFound
     */
    public function getOrder(Store $store, string $orderId): array
    {
        try {
            $accessToken = $this->hasAccessToken($store);

            $orderURL = $this->getStoreURL($store->slug);
            $orderURL .= Str::replace("{id}", $orderId, self::GET_ORDER_ENDPOINT);
            $orderURL .= "&access_token={$accessToken}";

            $response = $this->client->request('GET', $orderURL, 
                [
                    'headers'   => [
                        'Accept'        => 'application/json'
                    ]
                ]
            );

            $data = json_decode($response->getBody(), true);

            if (!isset($data['order']) || $response->getStatusCode() !== Response::HTTP_OK) {
                throw new OrderNotFound();
            }

            return $data['order'];
        } catch (Exception | ClientException | RequestException $ex) {
            return [$ex->getMessage()];
            Log::error($ex->getMessage(), [
                'context'   =>  'store:get-order',
                'code'      =>  $ex->getCode(),
                'line'      =>  $ex->getLine(),
                'file'      =>  $ex->getFile(),
                'trace'     =>  $ex->getTrace()
            ]);

            throw new OrderNotFound();
        }
    }
    
    /**
     * @throws FetchResourcesFailed
     */
    public function getOrders(Store $store): array
    {
        try {
            $accessToken = $this->hasAccessToken($store);

            $orderURL = $this->getStoreURL($store->slug);
            $orderURL .= self::GET_ORDERS_ENDPOINT;
            $orderURL .= "&access_token={$accessToken}";

            $response = $this->client->request('GET', $orderURL, 
                [
                    'headers'   => [
                        'Accept'        => 'application/json'
                    ]
                ]
            );

            $data = json_decode($response->getBody(), true);
            if (!isset($data['orders']) || $response->getStatusCode() !== Response::HTTP_OK) {
                throw new FetchResourcesFailed();
            }

            return $data['orders'];
        } catch (Exception | ClientException | RequestException $ex) {
            return [$ex->getMessage()];
            Log::error($ex->getMessage(), [
                'context'   =>  'store:get-orders',
                'code'      =>  $ex->getCode(),
                'line'      =>  $ex->getLine(),
                'file'      =>  $ex->getFile(),
                'trace'     =>  $ex->getTrace()
            ]);

            throw new FetchResourcesFailed();
        }
    }
    
    /**
     * @throws ProductNotFound
     */
    public function getProduct(Store $store, string $productId): array
    {
        try {
            $accessToken = $this->hasAccessToken($store);

            $productURL = $this->getStoreURL($store->slug);
            $productURL .= Str::replace("{id}", $productId, self::GET_PRODUCT_ENDPOINT);
            $productURL .= "?access_token={$accessToken}";

            $response = $this->client->request('GET', $productURL, 
                [
                    'headers'   => [
                        'Accept'        => 'application/json'
                    ]
                ]
            );

            $data = json_decode($response->getBody(), true);

            if (!isset($data['product']) || $response->getStatusCode() !== Response::HTTP_OK) {
                throw new CustomerNotFound();
            }

            return $data['product'];
        } catch (Exception | ClientException | RequestException $ex) {
            return [$ex->getMessage()];
            Log::error($ex->getMessage(), [
                'context'   =>  'store:get-order',
                'code'      =>  $ex->getCode(),
                'line'      =>  $ex->getLine(),
                'file'      =>  $ex->getFile(),
                'trace'     =>  $ex->getTrace()
            ]);

            throw new ProductNotFound();
        }
    }
    
    /**
     * @throws CancelSubscriptionFailed
     */
    public function cancelSubscription(Store $store, string $chargeId): bool
    {
        try {
            $accessToken = $this->hasAccessToken($store);

            $chargeURL = $this->getStoreURL($store->slug);
            $chargeURL .= Str::replace("{id}", $chargeId, self::DELETE_CHARGE_ENDPOINT);
            $chargeURL .= "?access_token={$accessToken}";

            $response = $this->client->request('DELETE', $chargeURL, 
                [
                    'headers'   => [
                        'Accept'        => 'application/json'
                    ]
                ]
            );

            return $response->getStatusCode() === Response::HTTP_OK;
        } catch (Exception | ClientException | RequestException $ex) {
            Log::error($ex->getMessage(), [
                'context'   =>  'store:cancel-billing',
                'code'      =>  $ex->getCode(),
                'line'      =>  $ex->getLine(),
                'file'      =>  $ex->getFile(),
                'trace'     =>  $ex->getTrace()
            ]);

            throw new CancelSubscriptionFailed();
        }
    }
    
    public function createScriptTag(Store $store): array
    {
        try {
            $accessToken = $this->hasAccessToken($store);

            $scriptTagURL = $this->getStoreURL($store->slug);
            $scriptTagURL .= self::POST_SCRIPT_TAG_ENDPOINT;

            $requestBody['script_tag'] = [
                'event'         =>  'onload',
                'display_scope' =>  'order_status',
                'src'           =>  url('/order_status.js')
            ];

            $requestBody['access_token'] = $accessToken;

            $response = $this->client->request('POST', $scriptTagURL, 
                [
                    'form_params'      => $requestBody,
                    'headers'   => [
                        'Accept'        => 'application/json',
                        'Content-Type'  => 'application/x-www-form-urlencoded',
                    ]
                ]
            );

            $data = json_decode($response->getBody(), true);
            if (!isset($data['script_tag'], $data['script_tag']['id'])) {
                throw new IntegateAppLayoutToThemeFailed();
            }

            return $data['script_tag'];
        } catch (Exception | ClientException | RequestException $ex) {
            Log::error($ex->getMessage(), [
                'context'   =>  'store:integrate-script-tag',
                'code'      =>  $ex->getCode(),
                'line'      =>  $ex->getLine(),
                'file'      =>  $ex->getFile(),
                'trace'     =>  $ex->getTrace()
            ]);

            throw new IntegateAppLayoutToThemeFailed();
        }
    }

    /**
     * @throws CreatePriceRuleFailed
     */
    public function createPriceRule(Store $store, array $priceRule): array
    {
        try {
            $accessToken = $this->hasAccessToken($store);

            $priceRuleURL = $this->getStoreURL($store->slug);
            $priceRuleURL .= self::POST_PRICE_RULE_ENDPOINT;

            $requestBody['access_token'] = $accessToken;

            $priceRule = array_merge(
                $priceRule, 
                [
                    'target_selection'      =>  'all',
                    'customer_selection'    =>  'all',
                    'allocation_method'     =>  'across',
                    'target_type'           =>  'line_item',
                    'starts_at'             =>  Carbon::now()->toIso8601String()
                ]
            );
            $requestBody['price_rule'] = $priceRule;

            $response = $this->client->request('POST', $priceRuleURL, 
                [
                    'form_params'      => $requestBody,
                    'headers'   => [
                        'Accept'        => 'application/json',
                        'Content-Type'  => 'application/x-www-form-urlencoded',
                    ]
                ]
            );

            $data = json_decode($response->getBody(), true);

            if (!isset($data['price_rule'], $data['price_rule']['id'])) {
                throw new CreatePriceRuleFailed();
            }

            return $this->createDiscount($store, $data['price_rule']);
        } catch (CreateDiscountFailed $ex) {
            throw $ex;
        } catch (Exception | ClientException | RequestException $ex) {
            Log::error($ex->getMessage(), [
                'context'   =>  'store:create-price-rule',
                'code'      =>  $ex->getCode(),
                'line'      =>  $ex->getLine(),
                'file'      =>  $ex->getFile(),
                'trace'     =>  $ex->getTrace()
            ]);

            throw new CreatePriceRuleFailed();
        }
    }
    
    /**
     * @throws CreateDiscountFailed
     */
    public function createDiscount(Store $store, array $priceRule): array
    {
        try {
            $accessToken = $this->hasAccessToken($store);

            $discountURL = $this->getStoreURL($store->slug);
            $discountURL .= Str::replace("{id}", $priceRule['id'], self::POST_DISCOUNT_ENDPOINT);
            $discountURL .= "?access_token={$accessToken}";
            
            $requestBody['discount_code'] = [
                'code' => $priceRule['title']
            ];

            $response = $this->client->request('POST', $discountURL, 
                [
                    'body'      => json_encode($requestBody),
                    'headers'   => [
                        'Accept'        => 'application/json',
                        'Content-Type'  => 'application/json',
                    ]
                ]
            );

            $data = json_decode($response->getBody(), true);

            if (!isset($data['discount_code'], $data['discount_code']['id'])) {
                throw new CreateDiscountFailed();
            }

            return $data['discount_code'];
        } catch (Exception | ClientException | RequestException $ex) {
            Log::error($ex->getMessage(), [
                'context'   =>  'store:create-discount',
                'code'      =>  $ex->getCode(),
                'line'      =>  $ex->getLine(),
                'file'      =>  $ex->getFile(),
                'trace'     =>  $ex->getTrace()
            ]);

            throw new CreateDiscountFailed();
        }
    }

    public function getStoreName(string $storeURL = null): ?string
    {
        if (!is_null($storeURL)) {
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
    
    private function createBillingChargeApplication(Store $store, array $charge): array
    {
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

        return json_decode($response->getBody(), true);  
    }
}