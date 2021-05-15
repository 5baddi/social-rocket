<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Dashboard\Account;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use BADDIServices\SocialRocket\Services\PackService;
use BADDIServices\SocialRocket\Services\SettingService;

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

        return view('dashboard.accounts', [
            'title'         =>  'Account',
            'tab'           =>  $request->query('tab', 'settings'),
            'currencies'    =>  SettingService::CURRENCIES_LIST,
            'user'          =>  $user,
            'currentPack'   =>  $this->packService->loadCurrentPack($user)
        ]);
    }
}