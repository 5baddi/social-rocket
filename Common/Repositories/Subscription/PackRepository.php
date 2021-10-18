<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Repositories\Subscription;

use BADDIServices\SocialRocket\Common\Repositories\EloquentRepository;
use BADDIServices\SocialRocket\Models\Pack;

class PackRepository extends EloquentRepository
{
    /** @var string */
    protected $model = Pack::class;
}
