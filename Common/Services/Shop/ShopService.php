<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Services\Shop;

use BADDIServices\SocialRocket\Common\Entities\Shop\Shop;
use BADDIServices\SocialRocket\Common\Managers\Shop\ShopManager;
use BADDIServices\SocialRocket\Common\Services\Service;

class ShopService extends Service
{
    public function __construct(
        private ShopManager $shopManager
    )
    {
        parent::__construct();
    }

    public function findBySlug(string $slug): ?Shop
    {
        return $this->shopManager->first([
            Shop::SLUG_COLUMN => strtolower($slug)
        ]);
    }
}
