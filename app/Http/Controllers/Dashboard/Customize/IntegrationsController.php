<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Dashboard\Customize;

use BADDIServices\SocialRocket\Http\Controllers\DashboardController;

class IntegrationsController extends DashboardController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function __invoke()
    {
        return view('dashboard.customize.integrations', [
            'title'                 =>  'Integrations',
            'setting'               =>  $this->setting,
            'store'                 =>  $this->store->slug
        ]);
    }
}