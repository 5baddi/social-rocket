<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use BADDIServices\SocialRocket\Models\Tracker;
use BADDIServices\SocialRocket\Repositories\TrackerRepository;

class TrackerService extends Service
{
    /** @var TrackerRepository */
    private $trackerRepository;

    public function __construct(TrackerRepository $trackerRepository)
    {
        $this->trackerRepository = $trackerRepository;
    }

    public function settings(): Tracker
    {
        return $this->trackerRepository->first();
    }
}