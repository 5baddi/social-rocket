<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Validators\Subscription;

use BADDIServices\SocialRocket\Common\Validators\Validator;
use BADDIServices\SocialRocket\Models\Subscription\PackFeature;

class PackFeatureValidator extends Validator
{
    public function rules(string $action = self::ACTION_CREATE): array
    {
        return [
            PackFeature::KEY_COLUMN                 => ['required', 'integer'],
            PackFeature::NAME_KEY_COLUMN            => ['required', 'string', 'min:2', 'max:100'],
            PackFeature::VALUE_COLUMN               => ['required', 'integer'],
            PackFeature::ICON_COLUMN                => ['nullable', 'string'],
            PackFeature::DESCRIPTION_COLUMN         => ['nullable', 'string'],
        ];
    }
}
