<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Services;

use BADDIServices\SocialRocket\Common\FeatureList;

class FeatureService extends Service
{
    public function __construct()
    {
        parent::__construct();
    }

    public function isFeatureEnabled(string $feature): bool
    {
        if (! in_array($feature, FeatureList::all())) {
            return false;
        }

        $key = sprintf('baddi.%s.enabled', $feature);

        return config($key, false);
    }

    public function isFeatureDisabled(string $feature): bool
    {
        return $this->isFeatureEnabled($feature) === false;
    }
}
