<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Repositories\Subscription;

use BADDIServices\SocialRocket\Common\Entities\Subscription\Feature;
use BADDIServices\SocialRocket\Common\Repositories\EloquentRepository;

class FeatureRepository extends EloquentRepository
{
    /** @var string */
    protected $model = Feature::class;
}
