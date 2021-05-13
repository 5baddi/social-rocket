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
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use BADDIServices\SocialRocket\Services\UserService;
use BADDIServices\SocialRocket\Http\Requests\SignUpRequest;
use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{
    /** @var UserService */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke(SignUpRequest $request)
    {
        try {
            $existsEmail = $this->userService->findByEmail($request->input(User::EMAIL_COLUMN));
            if (!$existsEmail) {
                return redirect('/signin')->withInput()->with("error", "No account registred with those credentials");
            }

            $user = $this->userService->create($request->input());
            abort_unless($user instanceof User, Response::HTTP_UNPROCESSABLE_ENTITY, 'Unprocessable user entity');

            $authenticateUser = Auth::attempt(['email' => $user->email, 'password' => $user->password]);
            if (!$authenticateUser) {
                return redirect('/signin')->with('error', 'Something going wrong with the authentification');
            }

            return redirect('/dashboard')->with('success', 'Welcome back ' . strtoupper($user->first_name));
        } catch (ValidationException $ex) {
            return redirect('/signin')->withInput()->withErrors($ex->errors());
        }  catch (Throwable $ex) {
            return redirect('/signin')->withInput()->with("error", "Internal server error");
        }
    }
}