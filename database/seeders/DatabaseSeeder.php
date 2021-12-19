<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BADDIServices\SocialRocket\Database\Seeders\PacksSeeder;
use BADDIServices\SocialRocket\Database\Seeders\SettingsSeeder;

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
            PacksSeeder::class,
            SettingsSeeder::class,
        ]);
    }
}
