<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Auth;

use Throwable;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use BADDIServices\SocialRocket\Services\UserService;
use BADDIServices\SocialRocket\Http\Requests\SignInRequest;
use Carbon\Carbon;

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
                return redirect('/signin')->withInput()->with("error", "No account registred with those credentials");
            }

            if (!$this->userService->verifyPassword($user, $request->input(User::PASSWORD_COLUMN))) {
                return redirect('/signin')->with('error', 'Something going wrong with the authentification');
            }

            $authenticateUser = Auth::attempt(['email' => $user->email, 'password' => $request->input(User::PASSWORD_COLUMN)]);
            if (!$authenticateUser) {
                return redirect('/signin')->with('error', 'Something going wrong with the authentification');
            }

            $this->userService->update($user, [
                User::LAST_LOGIN    =>  Carbon::now()
            ]);

            return redirect('/dashboard')->with('success', 'Welcome back ' . strtoupper($user->first_name));
        } catch (ValidationException $ex) {
            return redirect('/signin')->withInput()->withErrors($ex->errors());
        }  catch (Throwable $ex) {
            return redirect('/signin')->withInput()->with("error", "Internal server error");
        }
    }
}