<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\Auth\Subscription;

use Throwable;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use BADDIServices\ClnkGO\AppLogger;
use BADDIServices\ClnkGO\Models\Store;
use Symfony\Component\HttpFoundation\Response;
use BADDIServices\ClnkGO\Services\UserService;
use BADDIServices\ClnkGO\Services\StoreService;

class CancelController extends Controller
{
    /** @var StoreService */
    private $storeService;
    
    /** @var UserService */
    private $userService;

    public function __construct(StoreService $storeService, UserService $userService)
    {
        $this->storeService = $storeService;
        $this->userService = $userService;
    }

    public function __invoke()
    {
        try {
            /** @var User */
            $user = Auth::user();
            $user->load('store');

            $store = $user->store;
            abort_unless($store instanceof Store, Response::HTTP_NOT_FOUND, 'Store not found');
            
            $this->storeService->delete($store);
            $this->userService->delete($user);

            return redirect()->route('landing');
        } catch(Throwable $e) {
            AppLogger::setStore($store ?? null)->error($e, 'store:delete-account');

            return redirect()->route('subscription.select.pack')->with('error', 'Internal server error');
        }
    }
}