<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Database\Seeders;

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
            AppSetting::SUPPORT_EMAIL_COLUMN         =>  'support@trysocialrocket.com',
            AppSetting::INSTAGRAM_USERNAME_COLUMN    =>  'trysocialrocket',
            AppSetting::TWITTER_USERNAME_COLUMN      =>  'TrySocialRocket',
            AppSetting::FACEBOOK_USERNAME_COLUMN     =>  'Trysocialrocketapp-103039265306555',
        ]);
    }
}
