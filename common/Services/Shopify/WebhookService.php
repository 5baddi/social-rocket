<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Services\Shopify;

use Illuminate\Support\Arr;

class WebhookService extends ShopifyService
{
    public const SUBSCRIBE_ENDPOINT = '/admin/api/{version}/webhooks.json';

    public const TOPIC_HEADER = 'X-Shopify-Topic';
    public const HMAC_HEADER = 'X-Shopify-Hmac-Sha256';
    public const SHOP_DOMAIN_HEADER = 'X-Shopify-Shop-Domain';
    public const API_VERSION_HEADER = 'X-Shopify-API-Version';
    public const WEBHOOK_ID_HEADER = 'X-Shopify-Webhook-Id';

    public const ORDERS_CREATE = 'orders/create';
    public const ORDERS_UPDATED = 'orders/updated';
    public const ORDERS_CANCELLED = 'orders/cancelled';
    public const ORDERS_PAID = 'orders/paid';

    public const TOPICS = [
        self::ORDERS_CREATE,
        self::ORDERS_UPDATED,
        self::ORDERS_CANCELLED,
        self::ORDERS_PAID,
    ];

    public function processWebhook(array $headers, array $payload): void
    {
        $topic = Arr::get($headers, self::TOPIC_HEADER);
        if (! $this->assertWebhookEventAndTopic($topic)) {
            // TODO: throw exception
        }
    }

    public function subscribe(string $topic): void
    {

    }

    private function assertWebhookEventAndTopic(?string $topic = null): bool
    {
        return !is_null($topic) && Arr::has(self::TOPICS, $topic);
    }
}
