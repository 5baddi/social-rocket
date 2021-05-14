<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use BADDIServices\SocialRocket\Models\AppSetting;
use BADDIServices\SocialRocket\Repositories\AppRepository;

class AppService extends Service
{
    /** @var AppRepository */
    private $appRepository;

    public function __construct(AppRepository $appRepository)
    {
        $this->appRepository = $appRepository;
    }

    public function settings(): AppSetting
    {
        return $this->appRepository->first();
    }
}