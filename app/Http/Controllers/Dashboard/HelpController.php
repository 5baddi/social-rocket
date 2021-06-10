<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class HelpController extends Controller
{
    public function __invoke()
    {
        if (!config('rocket.help_url')) {
            return redirect()->route('landing');
        }
        
        return redirect(config('rocket.help_url'));
    }
}