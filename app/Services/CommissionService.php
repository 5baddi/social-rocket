<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use App\Models\User;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Event;
use BADDIServices\SocialRocket\Models\Order;
use BADDIServices\SocialRocket\Models\Store;
use Illuminate\Database\Eloquent\Collection;
use BADDIServices\SocialRocket\Models\Setting;
use Illuminate\Pagination\LengthAwarePaginator;
use BADDIServices\SocialRocket\Models\Commission;
use BADDIServices\SocialRocket\Entities\StoreSetting;
use BADDIServices\SocialRocket\Repositories\CommissionRepository;
use BADDIServices\SocialRocket\Events\Affiliate\NewOrderCommission;
use Illuminate\Support\Arr;

class CommissionService extends Service
{
    /** @var CommissionRepository */
    private $commissionRepository;

    public function __construct(CommissionRepository $commissionRepository)
    {
        $this->commissionRepository = $commissionRepository;
    }

    public function paginatePaidCommissions(Store $store, CarbonPeriod $period, ?int $page = null): LengthAwarePaginator
    {
        return $this->commissionRepository->paginatePaidCommissions($store->id, $period->getStartDate(), $period->getEndDate(), $page);
    }
    
    public function paginateUnpaidCommissions(Store $store, CarbonPeriod $period, ?int $page = null): LengthAwarePaginator
    {
        return $this->commissionRepository->paginateUnpaidCommissions($store->id, $period->getStartDate(), $period->getEndDate(), $page);
    }

    public function exists(Store $store, User $affiliate, Order $order): ?Commission
    {
        return $this->commissionRepository->exists($store->id, $affiliate->customer_id, $order->id);
    }
    
    public function create(Store $store, User $affiliate, Order $order, float $amount): Commission
    {
        $filtredAttributes = [
            Commission::STORE_ID_COLUMN     => $store->id,
            Commission::ORDER_ID_COLUMN     => $order->id,
            Commission::AFFILIATE_ID_COLUMN => $affiliate->id,
            Commission::AMOUNT_COLUMN       => $amount ?? 0,
            Commission::STATUS_COLUMN       => $attributes[Commission::STATUS_COLUMN] ?? Commission::DEFAULT_STATUS,
        ];

        return $this->commissionRepository->create($filtredAttributes);
    }
    
    public function save(Store $store, User $affiliate, Order $order, float $amount): Commission
    {
        $filtredAttributes = [
            Commission::STORE_ID_COLUMN     => $store->id,
            Commission::ORDER_ID_COLUMN     => $order->id,
            Commission::AFFILIATE_ID_COLUMN => $affiliate->customer_id,
            Commission::AMOUNT_COLUMN       => $amount ?? 0,
            Commission::STATUS_COLUMN       => $attributes[Commission::STATUS_COLUMN] ?? Commission::DEFAULT_STATUS,
        ];

        return $this->commissionRepository->save(
            [
            Commission::STORE_ID_COLUMN     => $store->id,
            Commission::ORDER_ID_COLUMN     => $order->id,
            ],
            $filtredAttributes
        );
    }

    public function calculate(Store $store, User $affiliate, Order $order): Commission
    {
        $store->load('setting');

        /** @var Setting */
        $setting = $store->setting;
        if (!$setting instanceof Setting) {
            $setting = new StoreSetting();
        }

        $amount = $setting->commission_amount;
        if ($setting->commission_type === Setting::PERCENTAGE_TYPE) {
            $amount = ($setting->commission_amount / 100) * $order->total_price_usd;
        }

        $commission = $this->save($store, $affiliate, $order, $amount);
        if ($commission instanceof Commission) {
            Event::dispatch(new NewOrderCommission($store, $affiliate, $commission));
        }

        return $commission;
    }

    public function getUnpaidOrdersCommissions(Store $store, CarbonPeriod $period): float
    {
        return $this->commissionRepository->getUnpaidOrdersCommissions(
            $store->id, 
            $period->copy()->getStartDate(),
            $period->copy()->getEndDate()
        );
    }
    
    public function getPaidOrdersCommissions(Store $store, CarbonPeriod $period): float
    {
        return $this->commissionRepository->getPaidOrdersCommissions(
            $store->id, 
            $period->copy()->getStartDate(),
            $period->copy()->getEndDate()
        );
    }

    public function getTopAffiliates(CarbonPeriod $period, int $limit = 5): Collection
    {
        return $this->commissionRepository->getTopAffiliates($period, $limit);
    }
    
    public function getTopAffiliatesByStore(Store $store, CarbonPeriod $period, int $limit = 5): Collection
    {
        return $this->commissionRepository->getTopAffiliatesByStore($store->id, $period, $limit);
    }
    
    public function getTotalEarned(User $affiliate): float
    {
        return $this->commissionRepository->getTotalEarned($affiliate->customer_id);
    }
    
    public function getTotalEarnedByStore(Store $store, User $affiliate): float
    {
        return $this->commissionRepository->getTotalEarnedByStore($store->id, $affiliate->customer_id);
    }

    public function pay(Commission $commission, array $attributes): bool
    {
        return $this->commissionRepository->update(
            $commission->id,
            [
                Commission::PAYOUT_REFERENCE_COLUMN => Arr::get($attributes, Commission::PAYOUT_REFERENCE_COLUMN),
                Commission::PAYOUT_METHOD_COLUMN    => Arr::get($attributes, Commission::PAYOUT_METHOD_COLUMN),
                Commission::ADDITIONAL_INFO_COLUMN  => Arr::get($attributes, Commission::ADDITIONAL_INFO_COLUMN),
                Commission::STATUS_COLUMN           => Commission::PAID_STATUS,
                Commission::PAID_AT_COLUMN          => now(),
            ]
        );
    }
}