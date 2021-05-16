<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Dashboard\Customize;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Models\Setting;
use Symfony\Component\HttpFoundation\Response;

class CustomizeController extends Controller
{
    public function __invoke()
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
            abort_unless($setting instanceof Setting, Response::HTTP_NOT_FOUND, 'Setting not loaded!');
        }

        return view('dashboard.customize.index', [
            'title'                 =>  'Customize',
            'setting'               =>  $setting
        ]);
    }
}