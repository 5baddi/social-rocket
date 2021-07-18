<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Dashboard\Activity;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ActivityMarkAsReadController extends Controller
{
    public function __invoke(string $notificationId)
    {
        /** @var User */
        $user = Auth::user();

        $user->unreadNotifications->where('id', $notificationId)->markAsRead();

        return redirect()->route('dashboard.activity');
    }
}