<?php

namespace App\Actions\Product;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryContract;
use Illuminate\Support\Facades\DB;

/**
 * @property ProductRepository productRepository
 */
class DeleteProductAction
{
    public function __construct(private ProductRepositoryContract $productRepository) {}

    public function execute(Product $product)
    {

        return DB::transaction(function () use ($product) {
            $this->productRepository->delete($product->id);

            $product->clearMediaCollection('photo');

        });
    }
}
