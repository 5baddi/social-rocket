<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Admin\Pages;

use BADDIServices\SocialRocket\Http\Controllers\AdminController as ControllersAdminController;

class CreatePageController extends ControllersAdminController
{
    public function __invoke()
    {
        return view(
            'admin.pages.create', 
            [
                'title'     => 'Create new page',
            ]
        );
    }
}