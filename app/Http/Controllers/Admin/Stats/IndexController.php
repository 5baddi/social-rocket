<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Admin\Stats;

use App\Http\Requests\AnalyticsRequest;
use BADDIServices\SocialRocket\Http\Controllers\AdminController as ControllersAdminController;

class IndexController extends ControllersAdminController
{
    public function __invoke(AnalyticsRequest $request)
    {
        $last7Days = $this->statsService->getLast7DaysPeriod();
        $startDate = $request->input('start-date', $last7Days->copy()->getStartDate()->format('Y/m/d'));
        $endDate = $request->input('end-date', $last7Days->copy()->getEndDate()->format('Y/m/d'));

        return view('admin.stats.index', [
            'title'             =>  'Dashboard',
            'startDate'         =>  $startDate,
            'endDate'           =>  $endDate,
        ]);
    }
}