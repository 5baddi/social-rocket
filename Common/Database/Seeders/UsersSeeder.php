<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Database\Seeders;

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
            User::FIRST_NAME_COLUMN     =>  "Mohamed BADDI",
            User::EMAIL_COLUMN          =>  "services@baddi.info",
            User::PASSWORD_COLUMN       =>  "baddidev",
            User::IS_SUPERADMIN_COLUMN  =>  true
        ]);
    }
}
