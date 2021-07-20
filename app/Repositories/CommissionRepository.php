<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Repositories;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use BADDIServices\ClnkGO\Models\Commission;

class CommissionRepository
{
    public function paginatePaidCommissions(string $storeId, Carbon $startDate, carbon $endDate, ?int $page = null): LengthAwarePaginator
    {
        return Commission::query()
                    ->with(['order', 'affiliate'])
                    ->where([
                        Commission::STORE_ID_COLUMN => $storeId,
                        Commission::STATUS_COLUMN   => Commission::PAID_STATUS
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
                    ->paginate(10, ['*'], 'ap', $page);
    }
    
    public function paginateUnpaidCommissions(string $storeId, Carbon $startDate, carbon $endDate, ?int $page = null): LengthAwarePaginator
    {
        return Commission::query()
                    ->with(['order', 'affiliate'])
                    ->where(Commission::STORE_ID_COLUMN, $storeId)
                    ->where(Commission::STATUS_COLUMN, '!=', Commission::PAID_STATUS)
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
                    ->paginate(10, ['*'], 'pp', $page);
    }
    
    public function exists(string $storeId, int $affiliateId, string $orderId): ?Commission
    {
        return Commission::query()
                    ->where([
                        Commission::STORE_ID_COLUMN     => $storeId,
                        Commission::AFFILIATE_ID_COLUMN => $affiliateId,
                        Commission::ORDER_ID_COLUMN     => $orderId,
                    ])
                    ->first();
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
    
    public function update(string $commissionId, array $values): bool
    {
        $commissionUpdated = Commission::query()
                    ->where(Commission::ID_COLUMN, $commissionId)
                    ->update($values);

        return $commissionUpdated > 0;
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

    public function getTopAffiliates(CarbonPeriod $period, int $limit = 5): Collection
    {
        return Commission::query()
                    ->with(['affiliate', 'order'])
                    ->whereDate(Commission::CREATED_AT, '>=', $period->getStartDate())
                    ->whereDate(Commission::CREATED_AT, '<=', $period->getEndDate())
                    ->orderBy(Commission::AMOUNT_COLUMN, 'DESC')
                    ->groupBy(Commission::AFFILIATE_ID_COLUMN)
                    ->take($limit)
                    ->get();
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
    
    public function getTotalEarned(string $affiliateId): float
    {
        return Commission::query()
                    ->where(Commission::AFFILIATE_ID_COLUMN, $affiliateId)
                    ->sum(Commission::AMOUNT_COLUMN);
    }
    
    public function getTotalEarnedByStore(string $storeId, string $affiliateId): float
    {
        return Commission::query()
                    ->where(Commission::STORE_ID_COLUMN, $storeId)
                    ->where(Commission::AFFILIATE_ID_COLUMN, $affiliateId)
                    ->sum(Commission::AMOUNT_COLUMN);
    }
}