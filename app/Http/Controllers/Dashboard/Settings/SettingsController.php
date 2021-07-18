<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Dashboard\Settings;

use Throwable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Entities\Alert;
use BADDIServices\SocialRocket\Models\Setting;
use BADDIServices\SocialRocket\Entities\StoreSetting;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SettingsController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            /** @var User */
            $user = Auth::user();
            $user->load('store');

            $store = $user->store;
            if (!$store instanceof Store) {
                throw new NotFoundHttpException('Store not found!');
            }

            $store->load('setting');
            $setting = $store->setting;
            if(!$setting instanceof Setting) {
                $setting = new StoreSetting();
            }

            return view('dashboard.settings', [
                'title'         =>  'Settings',
                'tab'           =>  $request->query('tab', 'methods'),
                'setting'       =>  $setting
            ]);
        } catch (NotFoundHttpException $ex){
            return redirect()->route('dashboard.settings')
                            ->with(
                                'alert', 
                                new Alert($ex->getMessage())
                            )
                            ->withInput();
        } catch (Throwable $ex){
            return redirect()->route('dashboard.settings')
                            ->with(
                                'alert', 
                                new Alert('Error saving settings')
                            )
                            ->withInput();
        }
    }
}