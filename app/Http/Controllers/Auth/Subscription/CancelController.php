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
use BADDIServices\ClnkGO\Models\Store;
use Symfony\Component\HttpFoundation\Response;

class CancelController extends Controller
{
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
            $this->logger->setStore($store ?? null)->error($e, 'store:delete-account');

            return redirect()->route('subscription.select.pack')->with('error', 'Internal server error');
        }
    }
}