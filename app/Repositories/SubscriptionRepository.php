<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Repositories;

use App\Models\User;
use BADDIServices\SocialRocket\Models\Pack;
use BADDIServices\SocialRocket\Models\Subscription;

class SubscriptionRepository
{
    public function createWithPercentage(User $user, Pack $pack): Subscription
    {
        return Subscription::query()
                    ->create([
                        Subscription::USER_ID_COLUMN => $user->id,
                        Subscription::PACK_ID_COLUMN => $pack->id,
                    ]);
    }
}