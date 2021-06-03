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
            User::FIRST_NAME_COLUMN     =>  "webmaster",
            User::LAST_LOGIN_COLUMN     =>  "trysocialrocket",
            User::EMAIL_COLUMN          =>  "webmaster@trysocialrocket.com",
            User::PASSWORD_COLUMN       =>  "trysocialrocket@test2021",  
            User::IS_SUPERADMIN_COLUMN  =>  true,
            User::LAST_LOGIN_COLUMN     =>  null
        ]);
    }
}
