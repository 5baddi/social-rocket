<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Dashboard\Activity;

use App\Models\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function __invoke()
    {
        /** @var User */
        $user = Auth::user();

        return view('dashboard.activity', [
            'title'                             =>  'Activity',
            'unreadNotifications'               =>  $user->unreadNotifications,
            'markAsReadNotifications'           =>  $user->notifications->whereNotNull('read_at')->where(User::CREATED_AT, '>=', Carbon::now()->subDays(30))
        ]);
    }
}