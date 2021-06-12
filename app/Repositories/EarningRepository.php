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

class EarningRepository
{
    public function first(Store $store, Carbon $date): Earning
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

    public function save(Store $store, array $values, Carbon $date): Earning
    {
        $exists = $this->first($store, $date);
        if ($exists instanceof Earning) {
            return $exists->update($values);
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
}