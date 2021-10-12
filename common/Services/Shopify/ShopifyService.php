<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Services\Shopify;

use BADDIServices\SocialRocket\Common\Entities\Shopify\Shop;
use BADDIServices\SocialRocket\Common\Services\Service;
use BADDIServices\SocialRocket\Common\Services\Shopify\Exceptions\InvalidRequestSignatureException;
use BADDIServices\SocialRocket\Common\Services\Shopify\Exceptions\InvalidShopAccessTokenException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ShopifyService extends Service
{
    public const API_VERSION = '2021-10';
    public const SHOP_ENDPOINT = 'https://{shop}.myshopify.com';

    /** @var Client */
    private $client;

    public function __construct()
    {
        parent::__construct();

        $this->client = new Client([
            'debug'         => false,
            'http_errors'   => false,
        ]);
    }

    public function getShopURL(string $shopName): string
    {
        return (string)Str::replace("{shop}", $shopName, self::SHOP_ENDPOINT);
    }

    public function getShopName(string $shopURL): ?string
    {
        $checkUrl = preg_match(
            '/((http|https)\:\/\/)?[a-zA-Z0-9\.\/\?\:@\-_=#]+\.([a-zA-Z0-9\&\.\/\?\:@\-_=#])*/',
            $shopURL,
            $match
        );

        if (
            filter_var($shopURL, FILTER_VALIDATE_URL) !== false ||
            $checkUrl !== false
        ) {
            $shopURL = Str::startsWith($shopURL, 'http') ? Str::start($shopURL, 'https://') : $shopURL;

            $parseURL = parse_url($shopURL);
            $shopName = explode('.', $parseURL['host']);

            return $shopName[0] ?? null;
        }

        $shopURL = Str::replace("{shop}", $shopURL, self::SHOP_ENDPOINT);
        $shopHeaders = @get_headers((string) $shopURL);

        if (!$shopHeaders || $shopHeaders[0] == "HTTP/1.1 404 Not Found") {
            return null;
        }

        return $shopURL;
    }

    /**
     * @throws InvalidShopAccessTokenException
     * @throws GuzzleException
     */
    public function get(Shop $shop, string $action, array $attributes = []): array
    {
        $params = [
            'query'         => $attributes,
            'headers'       => [
                'Accept'    => 'application/json',
            ]
        ];

        return $this->send($shop, 'GET', $action, $params);
    }

    /**
     * @throws InvalidShopAccessTokenException
     * @throws GuzzleException
     */
    public function post(Shop $shop, string $action, array $attributes = []): array
    {
        $body = [
            'form_params'       => $attributes,
            'headers'           => [
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/x-www-form-urlencoded',
            ]
        ];

        return $this->send($shop, 'POST', $action, $body);
    }

    /**
     * @throws InvalidRequestSignatureException
     */
    public function verifySignature(array $attributes): bool
    {
        $hmac = Arr::get($attributes, 'hmac');
        Arr::forget($attributes, 'hmac');
        ksort($attributes);

        $computedHmac = $this->generateSignature($attributes);
        if (! hash_equals($hmac, $computedHmac)) {
            throw new InvalidRequestSignatureException();
        }

        return true;
    }

    private function generateSignature(array $attributes): string
    {
        return hash_hmac('sha256', http_build_query($attributes), config('shopify.client_secret'));
    }

    /**
     * @throws InvalidShopAccessTokenException
     */
    private function isShopHasAccessToken(Shop $shop): void
    {
        if ($shop->getAccessToken() === null) {
            throw new InvalidShopAccessTokenException();
        }
    }

    /**
     * @throws InvalidShopAccessTokenException|GuzzleException
     */
    private function send(Shop $shop, string $method, string $action, ?array $attributes = []): ?array
    {
        $this->isShopHasAccessToken($shop);

        $endpoint = sprintf(
            '%s/%s?access_token=%s',
            $this->getShopURL($shop->getSlug()),
            $action,
            $shop->getAccessToken()
        );

        $response = $this->client->request($method, $endpoint, $attributes);

        return json_decode($response->getBody(), true);
    }
}
