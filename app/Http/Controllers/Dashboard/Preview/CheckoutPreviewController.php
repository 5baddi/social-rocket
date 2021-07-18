<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Dashboard\Preview;

use Faker\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutPreviewController extends Controller
{
    public function __invoke()
    {
        $faker = Factory::create();

        $random = [
            'code'          =>  strtoupper(substr(md5(uniqid(mt_rand(), true)) , 0, 8)),
            'secondCode'    =>  strtoupper(substr(md5(uniqid(mt_rand(), true)) , 0, 8)),
            'percentage'    =>  rand(10, 25),
            'order'         =>  rand(500, 2000),
            'price'         =>  round(rand(100, 999) / 10, 2),
            'discount'      =>  rand(7, 20),
            'shipping'      =>  floatval(rand(7, 20)),
            'card'          =>  rand(1000, 9999),
            'user'          =>  Auth::user(),
            'product'       =>  ucfirst($faker->word()) . ' Product',
            'city'          =>  ucwords($faker->city()),
            'zip'           =>  $faker->postcode(),
            'country'       =>  $faker->country(),
            'streetName'    =>  $faker->streetName(),
            'streetAddress' =>  $faker->streetAddress(),
        ];

        $random['total'] = ($random['price'] - $random['discount']) + $random['shipping'];

        return view('dashboard.preview.checkout', $random);
    }
}