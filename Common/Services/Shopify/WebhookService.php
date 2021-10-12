<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Services\Shopify;

use BADDIServices\SocialRocket\Common\Services\Service;
use Illuminate\Support\Arr;

class WebhookService extends Service
{
    private const TOPIC_HEADER = 'X-Shopify-Topic';

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

    private function assertWebhookEventAndTopic(?string $topic = null): bool
    {
        return !is_null($topic) && Arr::has(self::TOPICS, $topic);
    }
}
