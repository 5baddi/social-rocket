<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Entities\Shopify;

use BADDIServices\SocialRocket\Models\Store;

class Shop extends Store
{
    /** @var OAuth */
    private $oauth;

    public function getAccessToken(): ?string
    {
        return $this->oauth->getAccessToken();
    }
}
