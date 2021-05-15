<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use BADDIServices\SocialRocket\Models\Subscription;

class HasSubscription
{
    /**
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && strpos($request->path(), "dashboard") === 0 && strpos($request->path(), "logout") === false) {
            /** @var User */
            $user = Auth::user();
            $user->load('subscription');

            if(!$user->subscription instanceof Subscription && !in_array($user->subscription->status, [Subscription::DEFAULT_STATUS, Subscription::CHARGE_ACCEPTED])) {
                return redirect()->route('subscription.select.pack');
            }
        }

        return $next($request);
    }
}