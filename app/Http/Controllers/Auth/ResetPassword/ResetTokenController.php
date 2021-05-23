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
use BADDIServices\SocialRocket\Services\UserService;
use BADDIServices\SocialRocket\Http\Requests\Auth\ResetTokenRequest;
use BADDIServices\SocialRocket\Services\AppLogger;

class ResetTokenController extends Controller
{
    /** @var UserService */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke(ResetTokenRequest $request)
    {
        try {
            $user = $this->userService->findByEmail($request->input(User::EMAIL_COLUMN));
            if (!$user instanceof User) {
                return redirect()
                            ->route('reset')
                            ->withInput()
                            ->with('error', 'No account registred with this email');
            }

        } catch (ValidationException $ex) {
            return redirect()
                    ->route('reset')
                    ->withInput()
                    ->withErrors($ex->errors());
        }  catch (Throwable $ex) {
            AppLogger::error($ex, null, 'auth:send-reset-token', ['playload' => $request->all()]);

            return redirect()
                    ->route('reset')
                    ->withInput()
                    ->with("error", "Internal server error");
        }
    }
}