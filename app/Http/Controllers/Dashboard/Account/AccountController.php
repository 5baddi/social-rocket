<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\Dashboard\Account;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use BADDIServices\ClnkGO\Models\Store;
use BADDIServices\ClnkGO\Models\Setting;
use Symfony\Component\HttpFoundation\Response;
use BADDIServices\ClnkGO\Services\PackService;
use BADDIServices\ClnkGO\Entities\StoreSetting;
use BADDIServices\ClnkGO\Services\SettingService;

class AccountController extends Controller
{
    /** @var PackService */
    private $packService;

    public function __construct(PackService $packService)
    {
        $this->packService = $packService;
    }
    
    public function __invoke(Request $request)
    {
        /** @var User */
        $user = Auth::user();
        $user->load('store');
        
        $store = $user->store;
        if (!$store instanceof Store) {
            abort_unless($store instanceof Store, Response::HTTP_NOT_FOUND, 'Store not found!');
        }
        
        $store->load('setting');
        $setting = $store->setting;
        if (!$setting instanceof Setting) {
            $setting = new StoreSetting();
        }


        return view('dashboard.accounts', [
            'title'         =>  'Account',
            'tab'           =>  $request->query('tab', 'settings'),
            'currencies'    =>  SettingService::CURRENCIES_LIST,
            'user'          =>  $user,
            'currentPack'   =>  $this->packService->loadCurrentPack($user),
            'setting'       =>  $setting
        ]);
    }
}