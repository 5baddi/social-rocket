<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Affiliate\Inscription;

use Throwable;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Event;
use BADDIServices\SocialRocket\AppLogger;
use BADDIServices\SocialRocket\Models\Store;
use Illuminate\Validation\ValidationException;
use BADDIServices\SocialRocket\Events\WelcomeMail;
use BADDIServices\SocialRocket\Services\UserService;
use BADDIServices\SocialRocket\Http\Requests\AffiliateSignInRequest;

class CreateAccountController extends Controller
{
    /** @var UserService */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke(Store $store, AffiliateSignInRequest $request)
    {
        try {
            $exists = $this->userService->findByEmail($request->input(User::EMAIL_COLUMN));
            if ($exists) {
                return redirect()->back()->withInput()->with('error', 'Email already registered!');
            }

            $affiliate = $this->userService->create($store, $request->input(), true);

            Event::dispatch(new WelcomeMail($store, $affiliate, true));

            $this->userService->notifyStoreOwner($store, $affiliate);

            return redirect()->back()->with('success', 'Thank you for your inscription! please check your mailbox');
        } catch (ValidationException $e){
            return redirect()
                        ->back()
                        ->withInput()
                        ->withErrors($e->errors);
        } catch (Throwable $e) {
            AppLogger::setStore($store)->error($e, 'affiliate:signup');

            return redirect()->back()->withInput()->with('error', 'Something going wrong during inscription');
        }
    }
}