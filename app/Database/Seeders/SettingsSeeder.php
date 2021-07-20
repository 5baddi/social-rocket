<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Database\Seeders;

use BADDIServices\ClnkGO\Models\AppSetting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppSetting::create([
            AppSetting::SUPPORT_EMAIL         =>  'info@clnkgo.com',
            AppSetting::INSTAGRAM_USERNAME    =>  'clnkgo',
            AppSetting::TWITTER_USERNAME      =>  'clnkgo',
            AppSetting::FACEBOOK_USERNAME     =>  'clnkgo',
            AppSetting::LINKEDIN_USERNAME     =>  'clnkgo',
        ]);
    }
}
