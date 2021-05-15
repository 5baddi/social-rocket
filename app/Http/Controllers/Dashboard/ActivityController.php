<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Dashboard;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function __invoke()
    {
        /** @var User */
        $user = Auth::user();

        return view('dashboard.activity', [
            'title'         =>  'Activity',
            'notifications' =>  $user->notifications
        ]);
    }
}