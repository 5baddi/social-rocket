<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Database\Seeders;

use BADDIServices\SocialRocket\Models\Pack;
use Illuminate\Database\Seeder;

class PacksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pack::create([
            'name'              =>  'gravity',
            'amount'            =>  9.99,
            'type'              =>  Pack::TYPES[0],
            'symbol'            =>  '$',
            'currency'          =>  'usd',
            'features'          =>  [
                [
                    'key'       =>  Pack::UNLIMITED_AFFILIATES,
                    'name'      =>  'unlimited affiliates',
                    'enabled'   =>  true,
                ],
                [
                    'key'       =>  Pack::PAYOUT_METHODS,
                    'name'      =>  '5 payout methods',
                    'enabled'   =>  true,
                    'limit'     =>  5,
                ],
                [
                    'key'       =>  Pack::REPORTING,
                    'name'      =>  'dashboard And data reports',
                    'enabled'   =>  true,
                ],
                [
                    'key'       =>  Pack::CUSTOMIZATION,
                    'name'      =>  'full customization',
                    'enabled'   =>  true,
                ],
                [
                    'key'       =>  Pack::SUPPORT,
                    'name'      =>  'live chat support',
                    'enabled'   =>  true,
                ],
                [
                    'key'       =>  Pack::REVENUE_NOT_SHARED,
                    'name'      =>  '100% of revenue is your\'s',
                    'enabled'   =>  true,
                ],
            ]
        ]);
        
        Pack::create([
            'name'          =>  'Asteroid',
            'amount'        =>  10,
            'type'          =>  Pack::TYPES[1],
            'features'      =>  [
                [
                    'key'       =>  Pack::UNLIMITED_AFFILIATES,
                    'name'      =>  'unlimited affiliates',
                    'enabled'   =>  true,
                ],
                [
                    'key'       =>  Pack::PAYOUT_METHODS,
                    'name'      =>  '5 payout methods',
                    'enabled'   =>  true,
                    'limit'     =>  5,
                ],
                [
                    'key'       =>  Pack::REPORTING,
                    'name'      =>  'dashboard And data reports',
                    'enabled'   =>  true,
                ],
                [
                    'key'       =>  Pack::CUSTOMIZATION,
                    'name'      =>  'full customization',
                    'enabled'   =>  true,
                ],
                [
                    'key'       =>  Pack::SUPPORT,
                    'name'      =>  'live chat support',
                    'enabled'   =>  true,
                ],
                [
                    'key'       =>  Pack::REVENUE_NOT_SHARED,
                    'name'      =>  '100% of revenue is your\'s',
                    'enabled'   =>  false,
                ],
            ]
        ]);
    }
}
