<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Repositories;

use Carbon\Carbon;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Models\Earning;
use BADDIServices\SocialRocket\Models\Subscription;

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
}