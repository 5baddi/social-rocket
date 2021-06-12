<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Models\Earning;
use BADDIServices\SocialRocket\Repositories\EarningRepository;

class EarningService extends Service
{
    /** @var EarningRepository */
    private $earningRepository;

    public function __construct(EarningRepository $earningRepository)
    {
        $this->earningRepository = $earningRepository;
    }

    public function first(Store $store, ?Carbon $date = null): ?Earning
    {
        if ($date === null) {
            $date = Carbon::now();
        }
        
        return $this->earningRepository->first($store, $date);
    }
    
    public function save(Store $store, array $attributes, ?Carbon $date = null): Earning
    {
        Arr::set($attributes, Earning::STORE_ID_COLUMN, $store->id);

        $filteredAttributes = collect($attributes)
                        ->only([
                            Earning::STORE_ID_COLUMN,
                        ])
                        ->toArray();

        if ($date === null) {
            $date = Carbon::now();
        }

        return $this->earningRepository->save($store, $filteredAttributes, $date);
    }
    
    /**
     * @return Earning|false
     */
    public function update(Earning $earning, array $attributes): Earning
    {
        $filteredAttributes = collect($attributes)
                        ->only([
                            Earning::STORE_ID_COLUMN,
                        ])
                        ->toArray();

        $updated = $this->earningRepository->update($earning->id, $filteredAttributes);
        if ($updated) {
            return $earning->refresh();
        }

        return false;
    }
}