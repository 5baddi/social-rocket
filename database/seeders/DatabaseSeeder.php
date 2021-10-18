<?php

namespace Database\Seeders;

use BADDIServices\SocialRocket\Common\Database\Seeders\FeaturesSeeder;
use Illuminate\Database\Seeder;
use BADDIServices\SocialRocket\Common\Database\Seeders\PacksSeeder;
use BADDIServices\SocialRocket\Common\Database\Seeders\SettingsSeeder;
use BADDIServices\SocialRocket\Common\Database\Seeders\UsersSeeder;

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
            FeaturesSeeder::class,
            PacksSeeder::class,
            SettingsSeeder::class,
        ]);
    }
}
