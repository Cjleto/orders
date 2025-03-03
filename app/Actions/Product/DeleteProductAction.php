<?php

namespace App\Actions\Product;

use App\Models\Product;
use App\DTO\ProductDTO;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\ProductRepositoryContract;

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
