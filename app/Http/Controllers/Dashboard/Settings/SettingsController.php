<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('dashboard.settings.index', [
            'title'         =>  'Settings',
            'tab'           =>  $request->query('tab', 'methods'),
        ]);
    }
}