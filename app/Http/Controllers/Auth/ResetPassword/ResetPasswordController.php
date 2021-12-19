<?php

/**
 * Social Rocket
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
            $user = $this->userService->findByEmail($request->query(User::EMAIL_COLUMN));
            abort_if(!$user instanceof User, Response::HTTP_NOT_FOUND);

            return redirect()
                    ->route('signin')
                    ->with('success', 'Your password has been changed successfully.');
        } catch (ValidationException $ex) {
            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($ex->errors());
        }  catch (Throwable $ex) {
            AppLogger::error($ex, null, 'auth:send-reset-password', ['playload' => $request->all()]);

            return redirect()
                    ->back()
                    ->withInput()
                    ->with("error", "Internal server error");
        }
    }
}