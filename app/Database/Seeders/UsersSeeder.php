<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            User::FIRST_NAME_COLUMN     =>  "Test Account",
            User::EMAIL_COLUMN          =>  "project@baddi.info",
            User::PASSWORD_COLUMN       =>  "tryrocketapp@2021",  
            User::IS_SUPERADMIN_COLUMN  =>  true,
            User::LAST_LOGIN_COLUMN     =>  null
        ]);
    }
}
