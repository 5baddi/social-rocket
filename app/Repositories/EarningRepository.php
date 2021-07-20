<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use BADDIServices\ClnkGO\Models\Store;
use Illuminate\Database\Eloquent\Collection;
use BADDIServices\ClnkGO\Models\Earning;
use BADDIServices\ClnkGO\Models\Subscription;

class EarningRepository
{
    public function first(Store $store, Carbon $date): ?Earning
    {
        return Earning::query()
                    ->where(Earning::STORE_ID_COLUMN, $store->id)
                    ->whereDate(
                        Earning::CREATED_AT,
                        '>=',
                        $date->startOfDay()
                    )
                    ->whereDate(
                        Earning::CREATED_AT,
                        '<=',
                        $date->endOfDay()
                    )
                    ->first();
    }

    /**
     * @return Earning|false
     */
    public function save(Store $store, array $values, Carbon $date)
    {
        $exists = $this->first($store, $date);
        if ($exists instanceof Earning) {
            $updated = $exists->update($values);
            if (!$updated) {
                return false;
            }

            $exists->refresh();

            return $exists;
        }

        return Earning::query()
                        ->create($values);
    }
    
    public function update(string $id, array $values): bool
    {
        return Earning::query()
                        ->where(Earning::ID_COLUMN, $id)
                        ->update($values) === 1;
    }

    public function getEarnings(Carbon $startDate, carbon $endDate): float
    {
        return Earning::query()
            ->where([
                Earning::STATUS_COLUMN => Subscription::ACTIVE_STATUS
            ])
            ->whereDate(
                Earning::CREATED_AT,
                '>=',
                $startDate
            )
            ->whereDate(
                Earning::CREATED_AT,
                '<=',
                $endDate
            )
            ->sum(Earning::AMOUNT_COLUMN);
    }

    public function whereInPeriod(Carbon $startDate, Carbon $endDate): Collection
    {
        return Earning::query()
            ->select(DB::raw('SUM(amount) as total'), Earning::CREATED_AT, DB::raw('DATE(created_at) as date'))
            ->where(Earning::CREATED_AT, '>=', $startDate)
            ->where(Earning::CREATED_AT, '<=', $endDate)
            ->groupBy('date')
            ->orderBy(Earning::CREATED_AT, 'ASC')
            ->get();
    }
}