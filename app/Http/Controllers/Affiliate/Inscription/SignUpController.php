<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\Affiliate\Inscription;

use App\Http\Controllers\Controller;
use BADDIServices\ClnkGO\Models\Store;
use BADDIServices\ClnkGO\Models\Setting;
use BADDIServices\ClnkGO\Services\StoreService;

class SignUpController extends Controller
{
    /** @var StoreService */
    private $storeService;

    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
    }

    public function __invoke(string $storeName)
    {
        $store = $this->storeService->findBySlug($storeName);
        if (!$store instanceof Store) {
            return redirect('/');
        }

        $store->load('setting');
        $setting = $store->setting;
        
        if (!$setting instanceof Setting || !$setting->affiliate_form) {
            return redirect('/');
        }

        return view('affiliate.signup', [
            'store'         =>  $store
        ]);
    }
}