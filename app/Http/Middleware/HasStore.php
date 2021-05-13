<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class HasStore
{
    /**
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Cookie::has('store') && !is_null(Cookie::get('store'))) {
            return redirect('/signin');
        }

        return $next($request);
    }
}