<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Models\Setting;

class CouponService extends Service
{
    public function generateDiscountCode(Store $store, string $first_name): string
    {
        $store->load('setting');

        /** @var Setting */
        $setting = $store->setting;

        $uniqueNumber = substr(uniqid(mt_rand()), 0, 8);

        if (is_null($setting) || $setting->discount_amount === Setting::UNIQUE_DISCOUNT_FORMAT) {
            return strtoupper($first_name . $uniqueNumber);
        }

        $uniqueCode = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 4);

        return strtoupper($uniqueCode . $uniqueNumber);
    }
}