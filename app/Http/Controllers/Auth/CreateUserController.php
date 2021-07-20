<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\Auth;

use Throwable;
use App\Models\User;
use App\Http\Controllers\Controller;
use BADDIServices\ClnkGO\AppLogger;
use BADDIServices\ClnkGO\Events\WelcomeMail;
use BADDIServices\ClnkGO\Models\Store;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use BADDIServices\ClnkGO\Services\UserService;
use BADDIServices\ClnkGO\Http\Requests\SignUpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class CreateUserController extends Controller
{
    /** @var UserService */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke(Store $store, SignUpRequest $request)
    {
        try {
            $existsEmail = $this->userService->findByEmail($request->input(User::EMAIL_COLUMN));
            if ($existsEmail) {
                return redirect('/signup')->withInput()->with("error", "Email already registred with another account");
            }

            $user = $this->userService->create($store, $request->input());
            abort_unless($user instanceof User, Response::HTTP_UNPROCESSABLE_ENTITY, 'Unprocessable user entity');

            Event::dispatch(new WelcomeMail($store, $user));

            $authenticateUser = Auth::attempt(['email' => $user->email, 'password' => $request->input(User::PASSWORD_COLUMN)]);
            if (!$authenticateUser) {
                return redirect('/signin')->with('error', 'Something going wrong with the authentification');
            }

            return redirect('/dashboard')->with('success', 'Account created successfully');
        } catch (ValidationException $ex) {
            AppLogger::setStore($store ?? null)->error($ex, 'store:create-account', $request->all());

            return redirect('/signup')->withInput()->withErrors($ex->errors());
        }  catch (Throwable $ex) {
            AppLogger::setStore($store ?? null)->error($ex, 'store:create-account', $request->all());
            
            return redirect()->route('signup', ['store' => $store->id])->withInput()->with("error", "Internal server error");
        }
    }
}
