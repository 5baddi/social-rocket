<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Dashboard\Account;

use Throwable;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Entities\Alert;
use BADDIServices\SocialRocket\Services\UserService;
use BADDIServices\SocialRocket\Services\SettingService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use BADDIServices\SocialRocket\Http\Requests\UpdateAccountRequest;
use Illuminate\Validation\ValidationException;

class UpdateAccountController extends Controller
{
    /** @var UserService */
    private $userService;
    
    /** @var SettingService */
    private $settingService;

    public function __construct(UserService $userService, SettingService $settingService)
    {
        $this->userService = $userService;
        $this->settingService = $settingService;
    }
    
    public function __invoke(UpdateAccountRequest $request)
    {
        try {
            /** @var User */
            $user = Auth::user();
            $user->load('store');

            $store = $user->store;
            if (!$store instanceof Store) {
                throw new NotFoundHttpException('Store not found!');
            }

            if (!is_null($request->input('current_password')) && !$this->userService->verifyPassword($user, $request->input('current_password'))) {
                return redirect()->route('dashboard.account')
                                ->with(
                                    'alert', 
                                    new Alert('Current passwrod not match your credential')
                                )
                                ->withInput();
            }
            
            if ($request->input(User::EMAIL_COLUMN) !== $user->email && $this->userService->findByEmail($request->input(User::EMAIL_COLUMN)) instanceof User) {
                return redirect()->route('dashboard.account')
                                ->with(
                                    'alert', 
                                    new Alert('E-mail already taken by another account')
                                )
                                ->withInput();
            }

            $user = $this->userService->update($user, $request->input());
            Auth::setUser($user);

            $setting = $this->settingService->save($store, $request->input());

            return redirect()->route('dashboard.account', ['tab' => $request->query('tab', 'settings')])
                            ->with('setting', $setting)
                            ->with(
                                'alert', 
                                new Alert('Account settings changed successfully', 'success')
                            );
        } catch (ValidationException $ex){
            return redirect()->route('dashboard.account', ['tab' => $request->query('tab', 'settings')])
                            ->withErrors($ex->errors)
                            ->withInput();
        } catch (NotFoundHttpException $ex){
            return redirect()->route('dashboard.account', ['tab' => $request->query('tab', 'settings')])
                            ->with(
                                'alert', 
                                new Alert($ex->getMessage())
                            )
                            ->withInput();
        } catch (Throwable $ex){
            return redirect()->route('dashboard.account', ['tab' => $request->query('tab', 'settings')])
                            ->with(
                                'alert', 
                                new Alert('Error saving account settings')
                            )
                            ->withInput();
        }
    }
}