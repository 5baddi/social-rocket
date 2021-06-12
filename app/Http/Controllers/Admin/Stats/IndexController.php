<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Admin\Stats;

use Carbon\Carbon;
use App\Http\Requests\AnalyticsRequest;
use BADDIServices\SocialRocket\Http\Controllers\AdminController as ControllersAdminController;

class IndexController extends ControllersAdminController
{
    public function __invoke(AnalyticsRequest $request)
    {
        $last7Days = $this->statsService->getLast7DaysPeriod();
        $startDate = $request->input('start-date', $last7Days->copy()->getStartDate()->format('Y/m/d'));
        $endDate = $request->input('end-date', $last7Days->copy()->getEndDate()->format('Y/m/d'));

        $period = $this->statsService->getPeriod(Carbon::parse($startDate . ' 00:00:00'), Carbon::parse($endDate . ' 23:59:59'));

        return view('admin.stats.index', [
            'title'                         =>  'Dashboard',
            'startDate'                     =>  $startDate,
            'endDate'                       =>  $endDate,
            'sales'                         =>  $this->statsService->getAllOrdersEarnings($period),
            'orders_count'                  =>  sprintf('%02d', $this->statsService->getAllNewOrdersCount($period)),
            'affiliates_count'              =>  sprintf('%02d', $this->statsService->getAllNewAffiliatesCount($period)),
            'verified_affiliates_count'     =>  sprintf('%02d', $this->statsService->getAllNewVerifiedAffiliatesCount($period)),
            'stores_count'                  =>  sprintf('%02d', $this->statsService->getNewStoresCount($period)),
            'active_stores_count'           =>  sprintf('%02d', $this->statsService->getNewActiveStoresCount($period)),
            'earnings'                      =>  $this->statsService->getSubscriptionsEarnings($period),
            'active_subscriptions_count'    =>  sprintf('%02d', $this->statsService->getActiveSubscriptionsCount($period)),
        ]);
    }
}