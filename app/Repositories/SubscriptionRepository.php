<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Repositories;

use BADDIServices\SocialRocket\Models\Subscription;

class SubscriptionRepository
{   
    public function save(string $storeId, string $packId, array $attributes): Subscription
    {
        $attributes = array_merge($attributes, [
            Subscription::STORE_ID_COLUMN   => $storeId,
            Subscription::PACK_ID_COLUMN    => $packId,
        ]);

        return Subscription::query()
                    ->updateOrCreate(
                        [
                            Subscription::STORE_ID_COLUMN   => $storeId,
                            Subscription::PACK_ID_COLUMN    => $packId,
                        ],
                        $attributes
                    );
    }
}