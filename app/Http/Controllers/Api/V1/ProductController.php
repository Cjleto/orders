<?php

namespace App\Http\Controllers\Api\V1;

use App\DTO\ProductStoreDTO;
use App\DTO\ProductUpdateDTO;
use App\Http\Controllers\ApiController;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;


class ProductController extends ApiController
{
    public function __construct(
        protected ProductService $productService
    ) {}

    /**
     * @see OpenApiProduct::index()
     */
    public function index()
    {
        $products = $this->productService->getWithSortingAndIncludes();

        return ProductResource::collection($products);
    }

    /**
     * @see OpenApiProduct::store()
     */
    public function store(ProductRequest $request)
    {
        $validated = $request->validated();
        $dto = ProductStoreDTO::fromRequest($validated);
        $customer = $this->productService->create($dto);

        return $this->success(new ProductResource($customer), 201);
    }

    /**
     * @see OpenApiProduct::show()
     */
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

    /**
     * @see OpenApiProduct::destroy()
     */
    public function destroy(Product $product)
    {
        $this->productService->delete($product);

        return $this->success();
    }
}
