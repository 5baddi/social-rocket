<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Admin\Settings;

use Throwable;
use BADDIServices\SocialRocket\AppLogger;
use BADDIServices\SocialRocket\Entities\Alert;
use Illuminate\Validation\ValidationException;
use BADDIServices\SocialRocket\Services\AppService;
use BADDIServices\SocialRocket\Http\Requests\Admin\Settings\UpdateSettingsRequest;
use BADDIServices\SocialRocket\Http\Controllers\AdminController as ControllersAdminController;

class UpdateSettingsController extends ControllersAdminController
{
    /** @var AppService */
    private $appService;

    public function __construct(AppService $appService)
    {
        $this->appService = $appService;
    }

    public function __invoke(UpdateSettingsRequest $request)
    {
        try {
            // $this->appService->update($request->input());

            return redirect()
                ->back()
                ->with(
                    'alert', 
                    new Alert('Settings has been saved successfully', 'success')
                );
        } catch (ValidationException $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($e->errors());
        } catch (Throwable $e) {
            AppLogger::error($e, 'admin:update-settings');

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'alert', 
                    new Alert('Error during save settings')
                );
        }
    }
}