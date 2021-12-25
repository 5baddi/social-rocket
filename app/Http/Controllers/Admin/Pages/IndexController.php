<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Admin\Pages;

use BADDIServices\SocialRocket\Services\PageService;
use BADDIServices\SocialRocket\Http\Controllers\AdminController as ControllersAdminController;
use Illuminate\Http\Request;

class IndexController extends ControllersAdminController
{
    public function __construct(private PageService $pageService) {}

    public function __invoke(Request $request)
    {
        return view(
            'admin.pages.index', 
            [
                'title'     => 'Application pages',
                'pages'     => $this->pageService->paginate($request->query('page'))
            ]
        );
    }
}