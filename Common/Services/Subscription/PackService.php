<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Services\Subscription;

use BADDIServices\SocialRocket\Common\Managers\Subscription\PackManager;
use BADDIServices\SocialRocket\Common\Services\Service;
use Illuminate\Support\Collection;

class PackService extends Service
{
    /** @var PackManager */
    private $packManager;

    public function __construct(PackManager $packManager)
    {
        parent::__construct();

        $this->packManager = $packManager;
    }

    public function all(): Collection
    {
        return $this->packManager->all();
    }
}
