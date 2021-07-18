<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Auth\ResetPassword;

use Throwable;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use BADDIServices\SocialRocket\AppLogger;
use BADDIServices\SocialRocket\Services\UserService;
use BADDIServices\SocialRocket\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordController extends Controller
{
    /** @var UserService */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke(ResetPasswordRequest $request)
    {
        try {
            $user = $this->userService->verifyResetPasswordToken($request->input('token'));
            abort_if(!$user instanceof User, Response::HTTP_NOT_FOUND);

            $this->userService->update(
                $user,
                [
                    User::PASSWORD_COLUMN => Hash::make($request->input(User::PASSWORD_COLUMN))
                ]
            );

            $this->userService->removeResetPasswordToken($request->input('token'));

            return redirect()
                    ->route('signin')
                    ->with('success', 'Your password has been changed successfully.');
        } catch (ValidationException $e) {
            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($e->errors());
        }  catch (Throwable $e) {
            AppLogger::error($e, 'auth:send-reset-password', ['playload' => $request->all()]);

            return redirect()
                    ->back()
                    ->withInput()
                    ->with("error", "Internal server error");
        }
    }
}