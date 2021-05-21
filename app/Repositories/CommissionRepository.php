<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Repositories;

use Carbon\Carbon;
use BADDIServices\SocialRocket\Models\Commission;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Collection;

class CommissionRepository
{
    public function all(): Collection
    {
        return Commission::query()
                    ->all();
    }
    
    public function create(array $attributes): Commission
    {
        return Commission::query()
                    ->create($attributes);
    }
    
    public function save(array $attributes, array $values): Commission
    {
        return Commission::query()
                    ->updateOrCreate($attributes, $values);
    }

    public function getPaidOrdersCommissions(string $storeId, Carbon $startDate, carbon $endDate): float
    {
        return Commission::query()
            ->where([
                Commission::STORE_ID_COLUMN => $storeId
            ])
            ->whereDate(
                Commission::CREATED_AT,
                '>=',
                $startDate
            )
            ->whereDate(
                Commission::CREATED_AT,
                '<=',
                $endDate
            )
            ->where(
                Commission::STATUS_COLUMN,
                Commission::PAID_STATUS
            )
            ->sum(Commission::AMOUNT_COLUMN);
    }
    
    public function getUnpaidOrdersCommissions(string $storeId, Carbon $startDate, carbon $endDate): float
    {
        return Commission::query()
            ->where([
                Commission::STORE_ID_COLUMN => $storeId
            ])
            ->whereDate(
                Commission::CREATED_AT,
                '>=',
                $startDate
            )
            ->whereDate(
                Commission::CREATED_AT,
                '<=',
                $endDate
            )
            ->where(Commission::STATUS_COLUMN, Commission::DEFAULT_STATUS)
            ->sum(Commission::AMOUNT_COLUMN);
    }

    public function getTopAffiliatesByStore(string $storeId, CarbonPeriod $period, int $limit = 5): Collection
    {
        return Commission::query()
                    ->with(['affiliate', 'order'])
                    ->where(Commission::STORE_ID_COLUMN, $storeId)
                    ->whereDate(Commission::CREATED_AT, '>=', $period->getStartDate())
                    ->whereDate(Commission::CREATED_AT, '<=', $period->getEndDate())
                    ->orderBy(Commission::AMOUNT_COLUMN, 'DESC')
                    ->groupBy(Commission::AFFILIATE_ID_COLUMN)
                    ->take($limit)
                    ->get();
    }
    
    public function getTotalEarned(string $storeId, string $affiliateId): float
    {
        return Commission::query()
                    ->where(Commission::STORE_ID_COLUMN, $storeId)
                    ->where(Commission::AFFILIATE_ID_COLUMN, $affiliateId)
                    ->sum(Commission::AMOUNT_COLUMN);
    }
}