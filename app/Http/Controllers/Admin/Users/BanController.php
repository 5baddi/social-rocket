<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Admin\Users;

use App\Models\User;
use BADDIServices\SocialRocket\Entities\Alert;
use BADDIServices\SocialRocket\Http\Controllers\AdminController as ControllersAdminController;

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