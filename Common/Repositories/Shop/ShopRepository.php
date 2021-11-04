<?php

/**
 * Social Rocket
 *
 * @copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Repositories\Shop;

use BADDIServices\SocialRocket\Common\Entities\Shop\Shop;
use BADDIServices\SocialRocket\Common\Repositories\EloquentRepository;

class ShopRepository extends EloquentRepository
{
    /** @var string */
    protected $model = Shop::class;

    public function isLinked($shopName): bool
    {
        return $this->exists([
            Shop::SLUG_COLUMN => $shopName
        ]);
    }
}
