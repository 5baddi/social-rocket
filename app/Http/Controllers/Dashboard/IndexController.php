<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Dashboard;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\AnalyticsRequest;

class IndexController extends Controller
{
    public function __invoke(AnalyticsRequest $request)
    {
        return view('dashboard.index', [
            'title'     =>  'Dashboard',
            'period'    =>  Str::replace('_', ' ', $request->query('period'))
        ]);
    }
}