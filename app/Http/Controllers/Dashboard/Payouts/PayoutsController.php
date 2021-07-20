<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\Dashboard\Payouts;

use App\Http\Requests\AnalyticsRequest;
use Carbon\Carbon;
use BADDIServices\ClnkGO\Services\StatsService;
use BADDIServices\ClnkGO\Services\CommissionService;
use BADDIServices\ClnkGO\Http\Controllers\DashboardController;

class PayoutsController extends DashboardController
{
    /** @var CommissionService */
    private $commissionService;

    /** @var StatsService */
    private $statsService;

    public function __construct(CommissionService $commissionService, StatsService $statsService)
    {
        parent::__construct();

        $this->commissionService = $commissionService;
        $this->statsService = $statsService;
    }

    public function __invoke(AnalyticsRequest $request)
    {
        $last7Days = $this->statsService->getLast7DaysPeriod();
        $startDate = $request->input('start-date', $last7Days->copy()->getStartDate()->format('Y/m/d'));
        $endDate = $request->input('end-date', $last7Days->copy()->getEndDate()->format('Y/m/d'));

        $period = $this->statsService->getPeriod(Carbon::parse($startDate . ' 00:00:00'), Carbon::parse($endDate . ' 23:59:59'));

        $paidCommissions = $this->commissionService->paginatePaidCommissions($this->store, $period, $request->query('page'));
        $unpaidCommissions = $this->commissionService->paginateUnpaidCommissions($this->store, $period, $request->query('page'));

        return view('dashboard.payouts.index', [
            'title'             =>  'Payouts',
            'unpaidCommissions' =>  $unpaidCommissions,
            'paidCommissions'   =>  $paidCommissions
        ]);
    }
}