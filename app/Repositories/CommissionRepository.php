<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Repositories;

use Carbon\Carbon;
use App\Models\Commission;
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
}