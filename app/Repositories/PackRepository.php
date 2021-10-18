<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Repositories;

use BADDIServices\SocialRocket\Common\Repositories\EloquentRepository;
use BADDIServices\SocialRocket\Models\Pack;
use Illuminate\Database\Eloquent\Collection;

class PackRepository extends EloquentRepository
{
    public function __construct()
    {
        $this->model = Pack::class;
    }
}
