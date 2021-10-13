<?php

/**
 * Social Rocket
 *
 * @package Shopify
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\Packages\Shopify\Tests;


use BADDIServices\Packages\Shopify\ShopifyPackageServiceProvider;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function getPackageProviders($app)
    {
        return [
            ShopifyPackageServiceProvider::class
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        // TODO: perform environment setup
    }
}
