<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Services;

use BADDIServices\SocialRocket\Common\Entities\AppSetting;
use BADDIServices\SocialRocket\Common\Managers\AppManager;
use Illuminate\Support\Arr;

class AppService extends Service
{
    private AppManager $appManager;

    public function __construct(AppManager $appManager)
    {
        parent::__construct();

        $this->appManager = $appManager;
    }

    public function settings(): ?AppSetting
    {
        return $this->appManager->first();
    }

    public function update(array $attributes): bool
    {
        $attributes = Arr::only(
            $attributes,
            [
                AppSetting::INSTAGRAM_USERNAME_COLUMN,
                AppSetting::TWITTER_USERNAME_COLUMN,
                AppSetting::FACEBOOK_USERNAME_COLUMN,
                AppSetting::SUPPORT_EMAIL_COLUMN,
            ]
        );

        return $this->appManager->updateAny($attributes);
    }
}
