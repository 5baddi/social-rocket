<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Auth\ResetPassword;

use Throwable;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use BADDIServices\SocialRocket\AppLogger;
use BADDIServices\SocialRocket\Services\UserService;
use BADDIServices\SocialRocket\Http\Requests\Auth\ResetTokenRequest;

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

            DB::table('password_resets')->insert([
                'email'         => $request->email,
                'token'         => Str::random(60),
                'created_at'    => Carbon::now()
            ]);

            $tokenData = DB::table('password_resets')
                            ->where('email', $request->input(User::EMAIL_COLUMN))->first();

            return redirect()
                    ->back()
                    ->with('success', 'A reset link has been sent to your email address.');
        } catch (ValidationException $ex) {
            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($ex->errors());
        }  catch (Throwable $ex) {
            AppLogger::error($ex, null, 'auth:send-reset-token', ['playload' => $request->all()]);

            return redirect()
                    ->back()
                    ->withInput()
                    ->with("error", "Internal server error");
        }
    }
}