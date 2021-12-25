<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Admin\Pages;

use BADDIServices\SocialRocket\Http\Controllers\AdminController as ControllersAdminController;

class IndexController extends ControllersAdminController
{
    public function __invoke()
    {
        return view('admin.pages.index', [
            'title'     =>  'Application pages'
        ]);
    }
}