<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Admin\Users;

use App\Http\Requests\AnalyticsRequest;
use BADDIServices\SocialRocket\Http\Controllers\AdminController as ControllersAdminController;

class IndexController extends ControllersAdminController
{
    public function __invoke(AnalyticsRequest $request)
    {
        return view('admin.users.index', [
            'title'     =>  'accounts',
            'users'     =>  $this->userService->paginateWithRelations($request->query('page'))
        ]);
    }
}