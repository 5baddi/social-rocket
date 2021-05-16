<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Repositories;

use BADDIServices\SocialRocket\Models\Tracker;

class TrackerRepository
{
    public function first(): Tracker
    {
        return Tracker::query()
                    ->first();
    }
}