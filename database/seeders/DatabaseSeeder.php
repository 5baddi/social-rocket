<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BADDIServices\SocialRocket\Database\Seeders\PacksSeeder;
use BADDIServices\SocialRocket\Database\Seeders\SettingsSeeder;
use BADDIServices\SocialRocket\Database\Seeders\UsersSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            PacksSeeder::class,
            SettingsSeeder::class,
        ]);
    }
}
