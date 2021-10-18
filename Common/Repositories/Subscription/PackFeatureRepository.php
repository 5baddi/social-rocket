<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Repositories\Subscription;

use BADDIServices\SocialRocket\Common\Entities\Subscription\PackFeature;
use BADDIServices\SocialRocket\Common\Repositories\EloquentRepository;

class PackFeatureRepository extends EloquentRepository
{
    /** @var string */
    protected $model = PackFeature::class;
}
