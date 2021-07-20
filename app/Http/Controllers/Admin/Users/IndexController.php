<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\Admin\Users;

use App\Http\Requests\AnalyticsRequest;
use BADDIServices\ClnkGO\Http\Controllers\AdminController as ControllersAdminController;

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