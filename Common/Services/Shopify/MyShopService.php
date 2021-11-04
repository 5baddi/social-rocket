<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Services\Shopify;

use BADDIServices\SocialRocket\Common\Repositories\Shop\ShopRepository;
use BADDIServices\SocialRocket\Common\Services\Service;
use Illuminate\Support\Str;

class MyShopService extends Service
{
    public const SHOP_ENDPOINT = 'https://{shop}.myshopify.com';

    public function __construct(private ShopRepository $shopRepository)
    {
        parent::__construct();
    }

    public function getShopSlug(string $shopUrl): ?string
    {
        $checkUrl = preg_match(
            '/((http|https)\:\/\/)?[a-zA-Z0-9\.\/\?\:@\-_=#]+\.([a-zA-Z0-9\&\.\/\?\:@\-_=#])*/',
            $shopUrl,
            $match
        );

        if (
            filter_var($shopUrl, FILTER_VALIDATE_URL) !== false ||
            $checkUrl !== false
        ) {
            $shopUrl = ! Str::startsWith($shopUrl, 'http') ? Str::start($shopUrl, 'https://') : $shopUrl;

            $parseURL = parse_url($shopUrl);
            $shopName = explode('.', $parseURL['host'] ?? '');

            return $shopName[0] ?? null;
        }

        $shopUrl = (string)Str::replace("{shop}", $shopUrl, self::SHOP_ENDPOINT);
        $shopHeaders = @get_headers((string) $shopUrl);

        if (!$shopHeaders || $shopHeaders[0] == "HTTP/1.1 404 Not Found") {
            return null;
        }

        return $shopUrl;
    }

    public function shopIsAlreadyLinked(string $shopSlug): bool
    {
        return $this->shopRepository->isLinked($shopSlug);
    }

    public function getShopUrl(string $shopSlug): string
    {
        return (string)Str::replace('{shop}', $shopSlug, self::SHOP_ENDPOINT);
    }
}
