<?php

namespace App\Services;

use App\Models\Product;
use App\DTO\ProductStoreDTO;
use App\DTO\ProductUpdateDTO;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use App\Actions\Product\CreateProductAction;
use App\Actions\Product\DeleteProductAction;
use App\Actions\Product\UpdateProductAction;
use App\Repositories\Contracts\ProductRepositoryContract;

/**
 * @property ProductRepository productRepositoryContract
 */
class ProductService
{

    public function __construct(
        private ProductRepositoryContract $productRepository,
        private CreateProductAction $createProductAction,
        private UpdateProductAction $updateProductAction,
        private DeleteProductAction $deleteProductAction

    ) {}

    public function create(ProductStoreDTO $productStoreDTO): Product
    {

        return $this->createProductAction->execute($productStoreDTO);

    }

    public function update(ProductUpdateDTO $productUpdateDTO): Product
    {

        return $this->updateProductAction->execute($productUpdateDTO);

    }

    public function delete(Product $product): void
    {

        $this->deleteProductAction->execute($product);
    }

    public function getWithSortingAndIncludes(?int $perPage = null): Collection|Paginator
    {
        return $this->productRepository->getWithSortingAndIncludes();
    }
}
