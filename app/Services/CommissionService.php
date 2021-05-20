<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use App\Models\User;
use Carbon\CarbonPeriod;
use App\Models\Commission;
use BADDIServices\SocialRocket\Models\Order;
use BADDIServices\SocialRocket\Models\Store;
use Illuminate\Database\Eloquent\Collection;
use BADDIServices\SocialRocket\Models\Setting;
use BADDIServices\SocialRocket\Models\MailList;
use BADDIServices\SocialRocket\Entities\StoreSetting;
use BADDIServices\SocialRocket\Repositories\CommissionRepository;

class CommissionService extends Service
{
    /** @var CommissionRepository */
    private $commissionRepository;

    public function __construct(CommissionRepository $commissionRepository)
    {
        $this->commissionRepository = $commissionRepository;
    }

    public function all(): Collection
    {
        return $this->commissionRepository->all();
    }
    
    public function create(Store $store, MailList $mailList, Order $order, float $amount): Commission
    {
        $filtredAttributes = [
            Commission::STORE_ID_COLUMN     => $store->id,
            Commission::ORDER_ID_COLUMN     => $order->id,
            Commission::AFFILIATE_ID_COLUMN => $mailList->id,
            Commission::AMOUNT_COLUMN       => $amount ?? 0,
            Commission::STATUS_COLUMN       => $attributes[Commission::STATUS_COLUMN] ?? Commission::DEFAULT_STATUS,
        ];

        return $this->commissionRepository->create($filtredAttributes);
    }

    public function calculate(Store $store, MailList $mailList, Order $order): Commission
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

        return $this->create($store, $mailList, $order, $amount);
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
}