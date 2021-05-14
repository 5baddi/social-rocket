<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use App\Models\User;
use BADDIServices\SocialRocket\Models\Pack;
use BADDIServices\SocialRocket\Models\Subscription;
use BADDIServices\SocialRocket\Repositories\SubscriptionRepository;

class SubscriptionService extends Service
{
    /** @var SubscriptionRepository */
    private $subscriptionRepository;

    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    public function createWithPercentage(User $user, Pack $pack): Subscription
    {
        return $this->subscriptionRepository->createWithPercentage($user, $pack);
    }
}