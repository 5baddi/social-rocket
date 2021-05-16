<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Database\Seeders;

use BADDIServices\SocialRocket\Models\AppSetting;
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
            AppSetting::INSTAGRAM_USERNAME    =>  'trysocialrocket',
            AppSetting::TWITTER_USERNAME      =>  'TrySocialRocket',
            AppSetting::FACEBOOK_USERNAME     =>  'Trysocialrocketapp-103039265306555',
        ]);
    }
}
