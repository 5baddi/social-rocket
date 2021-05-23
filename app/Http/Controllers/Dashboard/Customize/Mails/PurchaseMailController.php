<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Dashboard\Customize\Mails;

use BADDIServices\SocialRocket\Http\Controllers\DashboardController;

class PurchaseMailController extends DashboardController
{
    public function __invoke()
    {
        return view('dashboard.customize.mails.purchase', [
            'store'                 =>  $this->store
        ]);
    }
}