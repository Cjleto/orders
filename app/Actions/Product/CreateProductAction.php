<?php

namespace App\Actions\Product;

use App\Models\Product;
use App\DTO\ProductStoreDTO;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\ProductRepositoryContract;
use Debugbar;

/**
 * @property ProductRepository productRepository
 */
class CreateProductAction
{
    public function __construct(private ProductRepositoryContract $productRepository) {}

    public function execute(ProductStoreDTO $productStoreDTO): Product
    {
        Debugbar::info('execute');

        return DB::transaction(function () use ($productStoreDTO) {
            $product = $this->productRepository->create([
                'name' => $productStoreDTO->name,
                'description' => $productStoreDTO->description,
                'price' => $productStoreDTO->price,
                'stock' => $productStoreDTO->stock,
            ]);

            if ($productStoreDTO->newPhoto) {
                $product->addMedia($productStoreDTO->newPhoto->getRealPath())
                    ->toMediaCollection('photo');
            }

            return $product;
        });
    }
}
