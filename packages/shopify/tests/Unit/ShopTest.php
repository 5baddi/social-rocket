<?php

/**
 * Social Rocket
 *
 * @package Shopify
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\Packages\Shopify\Tests\Unit;

use BADDIServices\Packages\Shopify\Entities\Shop;
use BADDIServices\Packages\Shopify\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShopTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_shop_has_slug()
    {
        $shop = Shop::factory()->create();

        $this->assertInstanceOf(Shop::class, $shop);
    }
}
