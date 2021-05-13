<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AppNotConnected
{
    /**
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('slug') || is_null(Session::get('slug'))) {
            return redirect('/connect');
        }

        return $next($request);
    }
}