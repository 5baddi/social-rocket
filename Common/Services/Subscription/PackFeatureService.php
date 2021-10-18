<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Services\Subscription;

use BADDIServices\SocialRocket\Common\Services\Service;

class PackFeatureService extends Service
{
    public function __construct(
        private PackFeatureService $packFeatureService
    )
    {
        parent::__construct();
    }
}
