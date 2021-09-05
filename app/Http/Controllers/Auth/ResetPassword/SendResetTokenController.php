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
use Illuminate\Support\Facades\Event;
use BADDIServices\SocialRocket\AppLogger;
use Illuminate\Validation\ValidationException;
use BADDIServices\SocialRocket\Events\Auth\ResetPassword;
use BADDIServices\SocialRocket\Http\Requests\Auth\ResetTokenRequest;
use BADDIServices\SocialRocket\Exceptions\Auth\FailedToGenerateToken;

class SendResetTokenController extends Controller
{
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

            $token = $this->userService->generateResetPasswordToken($user);
            if ($token === null) {
                throw new FailedToGenerateToken();
            }

            Event::dispatch(new ResetPassword($user, $token));

            return redirect()
                    ->back()
                    ->with('success', 'A reset link has been sent to your email address.');
        } catch (ValidationException $e) {
            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($e->errors());
        }  catch (Throwable $e) {
            AppLogger::error($e, 'auth:send-reset-token', ['playload' => $request->all()]);

            return redirect()
                    ->back()
                    ->withInput()
                    ->with("error", "Internal server error");
        }
    }
}