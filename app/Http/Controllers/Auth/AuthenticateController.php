<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Auth;

use Throwable;
use Carbon\Carbon;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use BADDIServices\SocialRocket\AppLogger;
use Illuminate\Validation\ValidationException;
use BADDIServices\SocialRocket\Services\UserService;
use BADDIServices\SocialRocket\Http\Requests\SignInRequest;

class AuthenticateController extends Controller
{
    /** @var UserService */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke(SignInRequest $request)
    {
        try {
            $user = $this->userService->findByEmail($request->input(User::EMAIL_COLUMN));
            if (!$user) {
                return redirect()->route('signin')->withInput()->with("error", "No account registred with those credentials");
            }

            if (!$this->userService->verifyPassword($user, $request->input(User::PASSWORD_COLUMN))) {
                return redirect()->route('signin')->with('error', 'Incorrect credentials, try again...');
            }

            $authenticateUser = Auth::attempt(['email' => $user->email, 'password' => $request->input(User::PASSWORD_COLUMN)]);
            if (!$authenticateUser) {
                return redirect()->route('signin')->with('error', 'Something going wrong with the authentification');
            }

            $this->userService->update($user, [
                User::LAST_LOGIN_COLUMN    =>  Carbon::now()
            ]);

            if ($user->isSuperAdmin()) {
                return redirect()->route('admin')->with('success', 'Welcome back ' . strtoupper($user->first_name));
            }
            
            return redirect()->route('dashboard')->with('success', 'Welcome back ' . strtoupper($user->first_name));
        } catch (ValidationException $e) {
            return redirect()->route('signin')->withInput()->withErrors($e->errors());
        }  catch (Throwable $e) {
            AppLogger::error($e, 'auth:signin', ['playload' => $request->all()]);

            return redirect()->route('signin')->withInput()->with("error", "Internal server error");
        }
    }
}