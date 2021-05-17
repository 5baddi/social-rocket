<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

class StatsService extends Service
{
    public function getLast7DaysPeriod(): CarbonPeriod
    {
        $now = Carbon::now();
        $queryInterval = new CarbonPeriod();
        $startDate = $now->copy()->subDays(7)->startOfDay();
        $endDate = $now->copy()->endOfDay();

        return $queryInterval
                    ->setStartDate($startDate)
                    ->setEndDate($endDate);
    }
}