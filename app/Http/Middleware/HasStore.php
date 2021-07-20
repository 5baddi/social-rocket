<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HasStore
{
    /**
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Session::has('store')) {
            return redirect()->route('connect');
        }

        return $next($request);
    }
}