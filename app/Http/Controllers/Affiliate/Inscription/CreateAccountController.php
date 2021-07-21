<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\Affiliate\Inscription;

use Throwable;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Event;
use BADDIServices\ClnkGO\Models\Store;
use Illuminate\Validation\ValidationException;
use BADDIServices\ClnkGO\Events\WelcomeMail;
use BADDIServices\ClnkGO\Services\UserService;
use BADDIServices\ClnkGO\Http\Requests\AffiliateSignInRequest;

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
            $this->logger->setStore($store)->error($e, 'affiliate:signup');

            return redirect()->back()->withInput()->with('error', 'Something going wrong during inscription');
        }
    }
}