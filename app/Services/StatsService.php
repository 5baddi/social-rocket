<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Services\OrderService;
use BADDIServices\SocialRocket\Services\CommissionService;

class StatsService extends Service
{
    /** @var OrderService */
    private $orderService;
    
    /** @var CommissionService */
    private $commissionService;

    public function __construct(OrderService $orderService, CommissionService $commissionService)
    {
        $this->orderService = $orderService;
        $this->commissionService = $commissionService;
    }

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
    
    public function getPeriod(Carbon $startDate, Carbon $endDate): CarbonPeriod
    {
        return CarbonPeriod::create($startDate, $endDate);
    }

    public function getOrdersEarnings(Store $store, CarbonPeriod $period): string
    {
        return sprintf(
            '%.2f',
            $this->orderService->getOrdersEarnings($store, $period)
        );
    }
    
    public function getNewOrdersCount(Store $store, CarbonPeriod $period): int
    {
        return $this->orderService->getNewOrdersCount($store, $period);
    }

    public function getPaidOrdersCommissions(Store $store, CarbonPeriod $period): string
    {
        return sprintf(
            '%.2f',
            $this->commissionService->getPaidOrdersCommissions($store, $period)
        );
    }
}