<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Admin\Settings;

use BADDIServices\SocialRocket\Http\Controllers\AdminController as ControllersAdminController;

class IndexController extends ControllersAdminController
{
    public function __invoke()
    {
        return view('admin.settings.index', [
            'title'     =>  'Application settings'
        ]);
    }
}