<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Admin\Users;

use Throwable;
use App\Models\User;
use BADDIServices\SocialRocket\AppLogger;
use BADDIServices\SocialRocket\Entities\Alert;
use Illuminate\Validation\ValidationException;
use BADDIServices\SocialRocket\Http\Requests\Admin\Users\UpdatePasswordRequest;
use BADDIServices\SocialRocket\Http\Controllers\AdminController as ControllersAdminController;

class ResetPasswordController extends ControllersAdminController
{
    public function __invoke(User $user, UpdatePasswordRequest $request)
    {
        try {
            $this->userService->update(
                $user, 
                [
                    User::PASSWORD_COLUMN => $request->input(User::PASSWORD_COLUMN)
                ]);
    
            return redirect()
                ->back()
                ->with(
                    'alert',
                    new Alert('Account password has been reseted successfully', 'success')
                );
        } catch (ValidationException $e) {
            $errors = collect($e->errors());

            return redirect()
                ->back()
                ->with(
                    'alert',
                    new Alert($errors->first())
                );
        } catch (Throwable $e) {
            AppLogger::error($e, 'admin:reset-user-password', ['user' => $user, 'playload' => $request->all()]);

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'alert', 
                    new Alert('Error during reseting account password')
                );
        }
    }
}