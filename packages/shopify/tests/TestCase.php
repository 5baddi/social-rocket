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
use Tests\CreatesApplication;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

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
        $app['config']->set('database.default', 'test_shopify_package');
        $app['config']->set(
            'database.connections.test_shopify_package',
            [
                'driver'   => 'sqlite',
                'database' => ':memory:',
                'prefix'   => '',
            ]
        );
    }
}
