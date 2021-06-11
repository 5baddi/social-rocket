<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Admin\Settings;

use Throwable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;
use BADDIServices\SocialRocket\AppLogger;
use BADDIServices\SocialRocket\Entities\Alert;
use Illuminate\Validation\ValidationException;
use BADDIServices\SocialRocket\Http\Requests\Admin\Settings\UpdateSettingsRequest;
use BADDIServices\SocialRocket\Http\Controllers\AdminController as ControllersAdminController;

class UpdateSettingsController extends ControllersAdminController
{
    public function __invoke(UpdateSettingsRequest $request)
    {
        try {
            $data = $request->validated();

            foreach ($data as $key => $value) {
                $value = Str::replace(' ', '_', $value);

                Artisan::call(sprintf('env:set %s=%s', strtoupper($key), $value));
            }

            // Artisan::call('config:clear');

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
            dd($e);
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