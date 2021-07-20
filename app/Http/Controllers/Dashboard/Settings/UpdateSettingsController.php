<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\Dashboard\Settings;

use Throwable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use BADDIServices\ClnkGO\Models\Store;
use BADDIServices\ClnkGO\Entities\Alert;
use BADDIServices\ClnkGO\Http\Requests\UpdateSettingsRequest;
use Illuminate\Validation\ValidationException;
use BADDIServices\ClnkGO\Services\SettingService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UpdateSettingsController extends Controller
{
    /** @var SettingService */
    private $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function __invoke(UpdateSettingsRequest $request)
    {
        try {
            /** @var User */
            $user = Auth::user();
            $user->load('store');

            $store = $user->store;
            if (!$store instanceof Store) {
                throw new NotFoundHttpException('Store not found!');
            }

            $setting = $this->settingService->savePayoutSetting($store, $request->input());

            return redirect()->route('dashboard.settings', ['tab' => $request->query('tab', 'methods')])
                            ->with('setting', $setting)
                            ->with(
                                'alert', 
                                new Alert('Settings changed successfully', 'success')
                            );
        } catch (ValidationException $ex){
            return redirect()->route('dashboard.settings', ['tab' => $request->query('tab', 'methods')])
                            ->withErrors($ex->errors)
                            ->withInput();
        } catch (NotFoundHttpException $ex){
            return redirect()->route('dashboard.settings', ['tab' => $request->query('tab', 'methods')])
                            ->with(
                                'alert', 
                                new Alert($ex->getMessage())
                            )
                            ->withInput();
        } catch (Throwable $ex){
            return redirect()->route('dashboard.settings', ['tab' => $request->query('tab', 'methods')])
                            ->with(
                                'alert', 
                                new Alert('Error saving settings')
                            )
                            ->withInput();
        }
    }
}