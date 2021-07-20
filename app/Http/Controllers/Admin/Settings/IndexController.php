<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\Admin\Settings;

use BADDIServices\ClnkGO\Http\Controllers\AdminController as ControllersAdminController;

class IndexController extends ControllersAdminController
{
    public function __invoke()
    {
        return view('admin.settings.index', [
            'title'     =>  'Application settings'
        ]);
    }
}