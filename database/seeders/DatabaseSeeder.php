<?php

namespace Database\Seeders;

use BADDIServices\SocialRocket\Database\Seeders\PacksSeeder;
use Illuminate\Database\Seeder;

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
            PacksSeeder::class
        ]);
    }
}
