<?php

namespace App\Actions\Product;

use App\DTO\ProductupdateDTO;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryContract;
use Illuminate\Support\Facades\DB;

/**
 * @property ProductRepository productRepository
 */
class UpdateProductAction
{
    public function __construct(private ProductRepositoryContract $productRepository) {}

    public function execute(ProductupdateDTO $productupdateDTO): Product
    {

        return DB::transaction(function () use ($productupdateDTO) {
            $product = $this->productRepository->update($productupdateDTO->id, [
                'name' => $productupdateDTO->name,
                'description' => $productupdateDTO->description,
                'price' => $productupdateDTO->price,
                'stock' => $productupdateDTO->stock,
            ]);

            if ($productupdateDTO->newPhoto) {
                $product->addMedia($productupdateDTO->newPhoto->getRealPath())
                    ->toMediaCollection('photo');
            }

            return $product;
        });
    }
}
