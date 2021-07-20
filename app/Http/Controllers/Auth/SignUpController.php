<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use BADDIServices\ClnkGO\Models\Store;
use BADDIServices\ClnkGO\Services\StoreService;

class SignUpController extends Controller
{
    /** @var StoreService */
    private $storeService;

    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
    }

    public function __invoke(Store $store)
    {
        return view('auth.signup', ['store' => $store]);
    }
}