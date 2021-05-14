<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use BADDIServices\SocialRocket\Models\Pack;
use Stripe\StripeClient;

class StripeService extends Service
{
    /** @var StripeClient */
    private $client;

    public function __construct()
    {
        $this->client = new StripeClient(
            [
                'api_key' => config('stripe.api_key')
            ]
        );
    }

    public function createPaymentIntent(Pack $pack)
    {
        return $this->client->paymentIntents->create([
            'amount'                =>  $pack->price,
            'currency'              =>  $pack->currency,
            'payment_method_types'  =>  ['card']
        ]);
    }
}