<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Repositories;

use BADDIServices\SocialRocket\Models\Earning;
use Carbon\Carbon;

class EarningRepository
{
    public function save(array $values, Carbon $date): Earning
    {
        $exists = Earning::query()
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