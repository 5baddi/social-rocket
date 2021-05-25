<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HasStore
{
    /**
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!is_null($request->query('store'))) {
            return redirect()->route('signin');
        }

        return $next($request);
    }
}