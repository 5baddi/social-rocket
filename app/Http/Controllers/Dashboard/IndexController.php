<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\User;
use App\Http\Requests\AnalyticsRequest;
use BADDIServices\SocialRocket\Services\StatsService;
use BADDIServices\SocialRocket\Http\Controllers\DashboardController;

class IndexController extends DashboardController
{
    /** @var StatsService */
    private $statsService;

    public function __construct(StatsService $statsService)
    {
        parent::__construct();

        $this->statsService = $statsService;
    }

    public function __invoke(AnalyticsRequest $request)
    {
        $last7Days = $this->statsService->getLast7DaysPeriod();
        $startDate = $request->input('start-date', $last7Days->copy()->getStartDate()->format('Y/m/d'));
        $endDate = $request->input('end-date', $last7Days->copy()->getEndDate()->format('Y/m/d'));

        $period = $this->statsService->getPeriod(Carbon::parse($startDate . ' 00:00:00'), Carbon::parse($endDate . ' 23:59:59'));

        return view('dashboard.index', [
            'title'                             =>  'Dashboard',
            'startDate'                         =>  $startDate,
            'endDate'                           =>  $endDate,
            'ordersEarnings'                    =>  $this->statsService->getOrdersEarnings($this->store, $period),
            'ordersEarningsChart'               =>  $this->statsService->getOrdersEarningsChart($this->store, $period),
            'newOrdersCount'                    =>  $this->statsService->getNewOrdersCount($this->store, $period),
            'paidOrdersCommissions'             =>  $this->statsService->getPaidOrdersCommissions($this->store, $period),
            'unpaidOrdersCommissions'           =>  $this->statsService->getUnpaidOrdersCommissions($this->store, $period),
            'topProducts'                       =>  $this->statsService->getOrdersTopProducts($this->store, $period),
            'topAffiliates'                     =>  $this->statsService->getTopAffiliatesByStore($this->store, $period),
            'unreadNotifications'               =>  $this->user->unreadNotifications,
            'markAsReadNotifications'           =>  $this->user->notifications->whereNotNull('read_at')->where(User::CREATED_AT, '>=', Carbon::now()->subDays(30)),
        ]);
    }
}