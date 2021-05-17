<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use BADDIServices\SocialRocket\Models\Product;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Repositories\ProductRepository;
use Illuminate\Support\Arr;

class ProductService extends Service
{
    /** @var ProductRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function first(): Product
    {
        return $this->productRepository->first();
    }
    
    public function findById(int $id): ?Product
    {
        return $this->productRepository
                    ->where([
                        Product::PRODUCT_ID_COLUMN => $id
                    ])
                    ->first();
    }
    
    public function save(Store $store, array $attributes): Product
    {
        Arr::set($attributes, Product::STORE_ID_COLUMN, $store->id);
        Arr::set($attributes, Product::PRODUCT_ID_COLUMN, $attributes[Product::ID_COLUMN]);
        Arr::set($attributes, Product::SLUG_COLUMN, $attributes['handle']);

        $attributes = collect($attributes)
                        ->only([
                            Product::STORE_ID_COLUMN,
                            Product::PRODUCT_ID_COLUMN,
                            Product::TITLE_COLUMN,
                            Product::SLUG_COLUMN
                        ])
                        ->toArray();

        return $this->productRepository
                    ->save($attributes);
    }
}