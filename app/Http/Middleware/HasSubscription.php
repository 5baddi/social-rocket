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
        if (Auth::check() && strpos($request->path(), "dashboard") === 0) {
            /** @var User */
            $user = Auth::user();
            $user->load('subscription');

            if(!$user->subscripotion instanceof Subscription && strpos($request->path(), "dashboard/subscription") === false) {
                return redirect('/dashboard/subscription');
            }
        }

        return $next($request);
    }
}