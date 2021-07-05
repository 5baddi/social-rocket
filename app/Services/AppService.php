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

    public function settings(): ?AppSetting
    {
        return $this->appRepository->first();
    }
    
    public function update(array $attributes): bool
    {
        $filteredAttributes = collect($attributes);
        $filteredAttributes = $filteredAttributes->only([
            AppSetting::INSTAGRAM_USERNAME,
            AppSetting::TWITTER_USERNAME,
            AppSetting::FACEBOOK_USERNAME,
            AppSetting::SUPPORT_EMAIL,
        ]);

        return $this->appRepository->update($filteredAttributes->toArray());
    }
}