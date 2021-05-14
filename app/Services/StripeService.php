<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use Stripe\StripeClient;

class StripeService extends Service
{
    /** @var StripeClient */
    private $client;

    public function __construct()
    {
        $this->client = new StripeClient(config('stripe.key'));
    }
}