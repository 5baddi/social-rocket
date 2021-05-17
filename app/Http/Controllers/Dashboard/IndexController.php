<?php

/**
 * Social Rocket
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

        return view('dashboard.index', [
            'title'                             =>  'Dashboard',
            'startDate'                         =>  $request->input('start-date', $last7Days->getStartDate()->format('Y/m/d')),
            'endDate'                           =>  $request->input('end-date', $last7Days->getEndDate()->format('Y/m/d')),
            'unreadNotifications'               =>  $this->user->unreadNotifications,
            'markAsReadNotifications'           =>  $this->user->notifications->whereNotNull('read_at')->where(User::CREATED_AT, '>=', Carbon::now()->subDays(30))
        ]);
    }
}