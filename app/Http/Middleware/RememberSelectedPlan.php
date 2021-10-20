<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Middleware;

use BADDIServices\SocialRocket\Common\Entities\Subscription\Pack;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RememberSelectedPlan
{
    /**
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->has('plan')) {
            Session::put('plan', $request->query('plan', Pack::ENTREPRENEUR));
        }

        return $next($request);
    }
}
