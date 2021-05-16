<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Requests\AnalyticsRequest;
use BADDIServices\SocialRocket\Http\Controllers\DashboardController;

class IndexController extends DashboardController
{
    public function __invoke(AnalyticsRequest $request)
    {
        return view('dashboard.index', [
            'title'     =>  'Dashboard',
            'period'    =>  Str::replace('_', ' ', $request->query('period')),
            'unreadNotifications'               =>  $this->user->unreadNotifications,
            'markAsReadNotifications'           =>  $this->user->notifications->whereNotNull('read_at')->where(User::CREATED_AT, '>=', Carbon::now()->subDays(30))
        ]);
    }
}