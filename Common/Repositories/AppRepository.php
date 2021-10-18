<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Repositories;

use BADDIServices\SocialRocket\Common\Entities\AppSetting;

class AppRepository extends EloquentRepository
{
    /** @var string */
    protected $model = AppSetting::class;
}
