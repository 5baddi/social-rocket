<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Services;

use BADDIServices\ClnkGO\Models\Product;
use BADDIServices\ClnkGO\Models\Store;
use BADDIServices\ClnkGO\Repositories\ProductRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

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
    
    public function getByIds(array $ids): Collection
    {
        $products = collect();

        foreach($ids as $id) {
            $product = $this->findById($id);

            if ($product instanceof Product) {
                $products->add($product);
            }
        }

        return $products;
    }
    
    public function getTopByIds(array $ids, int $limit = 5): Collection
    {
        return $this->productRepository->getTopByIds($ids, $limit);
    }
    
    public function save(Store $store, array $attributes): Product
    {
        Arr::set($attributes, Product::STORE_ID_COLUMN, $store->id);
        Arr::set($attributes, Product::PRODUCT_ID_COLUMN, $attributes[Product::ID_COLUMN]);
        Arr::set($attributes, Product::SLUG_COLUMN, $attributes['handle']);

        $image = collect($attributes['image']);
        Arr::set($attributes, Product::IMAGE_COLUMN, $image->get('src'));

        $attributes = collect($attributes)
                        ->only([
                            Product::STORE_ID_COLUMN,
                            Product::PRODUCT_ID_COLUMN,
                            Product::TITLE_COLUMN,
                            Product::SLUG_COLUMN,
                            Product::IMAGE_COLUMN,
                        ])
                        ->toArray();

        return $this->productRepository
                    ->save($attributes);
    }
}