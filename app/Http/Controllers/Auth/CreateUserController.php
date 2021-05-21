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
use BADDIServices\SocialRocket\Events\WelcomeMail;
use BADDIServices\SocialRocket\Models\Store;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use BADDIServices\SocialRocket\Services\UserService;
use BADDIServices\SocialRocket\Services\StoreService;
use BADDIServices\SocialRocket\Http\Requests\SignUpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;

class CreateUserController extends Controller
{
    /** @var UserService */
    private $userService;

    /** @var StoreService */
    private $storeService;

    public function __construct(UserService $userService, StoreService $storeService)
    {
        $this->userService = $userService;
        $this->storeService = $storeService;
    }

    public function __invoke(SignUpRequest $request)
    {
        try {
            $existsEmail = $this->userService->findByEmail($request->input(User::EMAIL_COLUMN));
            if ($existsEmail) {
                return redirect('/signup')->withInput()->with("error", "Email already registred with another account");
            }

            $store = $this->storeService->findBySlug(Session::get('slug'));
            abort_unless($store instanceof Store, Response::HTTP_NOT_FOUND, 'Store not found');

            $user = $this->userService->create($store, $request->input());
            abort_unless($user instanceof User, Response::HTTP_UNPROCESSABLE_ENTITY, 'Unprocessable user entity');

            Session::forget('slug');
            Event::dispatch(new WelcomeMail($user));

            $authenticateUser = Auth::attempt(['email' => $user->email, 'password' => $request->input(User::PASSWORD_COLUMN)]);
            if (!$authenticateUser) {
                return redirect('/signin')->with('error', 'Something going wrong with the authentification');
            }

            Cookie::put('store', $store->id);

            return redirect('/dashboard')->with('success', 'Account created successfully');
        } catch (ValidationException $ex) {
            $this->forgetStore();

            return redirect('/signup')->withInput()->withErrors($ex->errors());
        }  catch (Throwable $ex) {
            $this->forgetStore();
            
            return redirect('/signup')->withInput()->with("error", "Internal server error");
        }
    }

    private function forgetStore(): void
    {
        Cookie::forget('store');
    }
}
