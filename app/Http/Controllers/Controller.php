<?php

namespace App\Http\Controllers;

use App\Models\User;
use BADDIServices\ClnkGO\Logger;
use Illuminate\Support\Facades\Auth;
use BADDIServices\ClnkGO\Models\Store;
use Illuminate\Foundation\Bus\DispatchesJobs;
use BADDIServices\ClnkGO\Services\UserService;
use BADDIServices\ClnkGO\Services\StoreService;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** @var Logger */
    protected $logger;

    /** @var UserService */
    protected $userService;

    /** @var StoreService */
    protected $storeService;

    /** @var User|null */
    protected $user;

    /** @var Store|null */
    protected $store;

    public function __construct()
    {
        /** @var Logger */
        $this->logger = app(Logger::class);

        /** @var UserService */
        $this->userService = app(UserService::class);

        /** @var StoreService */
        $this->storeService = app(StoreService::class);

        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $this->user = $this->userService->findById(Auth::id());
    
                $this->store = $this->user->getMainStore();
            }

            return $next($request);
        });
    }
}