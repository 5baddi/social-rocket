<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\OAuth;

use Throwable;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use BADDIServices\ClnkGO\AppLogger;
use BADDIServices\ClnkGO\Models\OAuth;
use BADDIServices\ClnkGO\Models\Store;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use BADDIServices\ClnkGO\Events\WelcomeMail;
use BADDIServices\ClnkGO\Services\UserService;
use BADDIServices\ClnkGO\Services\StoreService;
use BADDIServices\ClnkGO\Services\ShopifyService;
use BADDIServices\ClnkGO\Http\Requests\OAuthCallbackRequest;

class OAuthCallbackController extends Controller
{
    /** @var ShopifyService */
    private $shopifyService;

    /** @var StoreService */
    private $storeService;
    
    /** @var UserService */
    private $userService;

    public function __construct(ShopifyService $shopifyService, StoreService $storeService, UserService $userService)
    {
        $this->shopifyService = $shopifyService;
        $this->storeService = $storeService;
        $this->userService = $userService;
    }
    
    public function __invoke(OAuthCallbackRequest $request)
    {
        try {
            $storeName = $this->shopifyService->getStoreName($request->query('shop'));
            $store = $this->storeService->findBySlug($storeName);
            if (!$store instanceof Store) {
                abort(Response::HTTP_NOT_FOUND, 'Store not found');
            }

            $accessToken = $this->shopifyService->getStoreAccessToken($request->query());
            $attributes = $request->merge($accessToken)->only([
                OAuth::STORE_ID_COLUMN,
                OAuth::CODE_COLUMN,
                OAuth::ACCESS_TOKEN_COLUMN,
                OAuth::SCOPE_COLUMN,
                OAuth::TIMESTAMP_COLUMN,
            ]);

            $oauth = $this->storeService->updateStoreOAuth($store, $attributes);
            abort_unless($oauth instanceof OAuth, Response::HTTP_BAD_REQUEST, 'Something going wrong during authentification');

            $this->storeService->updateConfigurations($store);
            $this->storeService->enableStore($store);

            $existsEmail = $this->userService->findByEmail($store->email);
            if ($existsEmail) {
                return redirect('/connect')
                    ->withInput([
                        'store' => $store->domain 
                    ])
                    ->with("error", "Email already registred with another store");
            }

            $user = $this->userService->create(
                $store,
                [
                    User::FIRST_NAME_COLUMN    => ucwords($store->name),
                    User::EMAIL_COLUMN         => $store->email,
                    User::PHONE_COLUMN         => $store->phone
                ]
            );

            Event::dispatch(new WelcomeMail($store, $user));

            $authenticateUser = Auth::loginUsingId($user->id);
            if (!$authenticateUser) {
                return redirect('/signin')->with('error', 'Something going wrong with the authentification');
            }

            return redirect('/dashboard')->with('success', 'Account created successfully');

            return redirect()
                ->route('signup', ['store' => $store->id]);
        } catch (ValidationException $ex) {
            AppLogger::setStore($store ?? null)->error($ex, 'store:oauth-callback', $request->all());

            $errors = collect($ex->errors());
            
            return redirect()
                ->route('connect')
                ->withInput()
                ->with('error', $errors->first());
        } catch (Throwable $ex) {
            AppLogger::setStore($store ?? null)->error($ex, 'store:oauth-callback', $request->all());
            
            return redirect()
                ->route('connect')
                ->with('error', 'Internal server error');
        }
    }
}
