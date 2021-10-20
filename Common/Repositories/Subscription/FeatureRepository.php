<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Repositories\Subscription;

use BADDIServices\SocialRocket\Common\Entities\Entity;
use BADDIServices\SocialRocket\Common\Entities\Subscription\Feature;
use BADDIServices\SocialRocket\Common\Repositories\EloquentRepository;
use Illuminate\Database\Eloquent\Collection;

class FeatureRepository extends EloquentRepository
{
    /** @var string */
    protected $model = Feature::class;
}
