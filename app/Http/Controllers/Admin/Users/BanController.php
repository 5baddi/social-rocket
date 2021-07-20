<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\Admin\Users;

use App\Models\User;
use BADDIServices\ClnkGO\Entities\Alert;
use BADDIServices\ClnkGO\Http\Controllers\AdminController as ControllersAdminController;

class BanController extends ControllersAdminController
{
    public function __invoke(User $user)
    {
        $this->userService->ban($user);

        return redirect()
                ->back()
                ->with(
                    'alert',
                    new Alert(sprintf('User %sbanned successfully', $user->isBanned() ? 'un' : ''), 'success')
                );
    }
}