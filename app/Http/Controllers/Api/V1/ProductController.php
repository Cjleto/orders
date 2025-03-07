<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Product;
use App\DTO\ProductStoreDTO;
use Illuminate\Http\Request;
use App\DTO\ProductUpdateDTO;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\ApiController;
use App\Http\Resources\ProductResource;

class ProductController extends ApiController
{

    public function __construct(
        protected ProductService $productService
    ) {}

    public function index()
    {
        $products = $this->productService->getWithSortingAndIncludes();
        return ProductResource::collection($products);
    }

    public function store(ProductRequest $request)
    {
        $validated = $request->validated();
        $dto = ProductStoreDTO::fromRequest($validated);
        $customer = $this->productService->create($dto);
        return $this->success(new ProductResource($customer));
    }

    public function show(Request $request, Product $product)
    {
        $product = $this->loadIncludes($request, $product);

        return new ProductResource($product);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $validated = $request->validated();
        $productUpdateDTO = ProductUpdateDTO::fromRequest($validated, $product->id);
        $product = $this->productService->update($productUpdateDTO);

        return $this->success(new ProductResource($product));
    }

    public function destroy(Product $product)
    {
        $this->productService->delete($product);
        return $this->success();
    }
}
