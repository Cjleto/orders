<?php

use App\Models\User;
use App\Models\Product;
use App\Services\UserService;
use Illuminate\Http\Response;
use App\Services\ProductService;
use App\Http\Resources\ProductResource;
use Database\Seeders\PermissionsRolesSeeder;

beforeEach(function () {

    $this->seed(PermissionsRolesSeeder::class);
    // Mock dei servizi
    $this->userService = mock(UserService::class);
    $this->productService = mock(ProductService::class);
    $this->app->instance(ProductService::class, $this->productService);

    $this->user = User::factory()->admin()->create();
    $this->actingAs($this->user);
});

it('can list all products', function () {

    $products = Product::factory()->count(3)->create();

    // Simula il comportamento del service
    $this->productService->shouldReceive('getWithSortingAndIncludes')
        ->once()
        ->andReturn($products);

    $response = $this->getJson('/api/v1/products');

    $response->assertStatus(Response::HTTP_OK)
        ->assertJson(ProductResource::collection($products)->response()->getData(true));
});

it('can create a product', function () {

    $product = Product::factory()->make();

    // Simula il comportamento del service
    $this->productService->shouldReceive('create')
        ->once()
        ->andReturn($product);

    $response = $this->postJson('/api/v1/products', $product->toArray());

    $response->assertStatus(Response::HTTP_CREATED)
        ->assertJson(ProductResource::make($product)->response()->getData(true));
});


it('can show a single product', function () {

    $product = Product::factory()->create();

    // Simula la chiamata API
    $response = $this->getJson(route('api.products.show', $product->id));

    $response->assertOk()
        ->assertJson(ProductResource::make($product)->response()->getData(true));
});


it('can update a product', function () {

    $product = Product::factory()->create();
    $newProduct = Product::factory()->make([
        'name' => 'Unique Name ' . uniqid() // Assicurati che il nome sia unico
    ]);

    // Simula il comportamento del service
    $this->productService->shouldReceive('update')
        ->once()
        ->andReturn($newProduct);

    $response = $this->putJson(route('api.products.update', $product->id), $newProduct->toArray());

    $response->assertOk()
        ->assertJson(ProductResource::make($newProduct)->response()->getData(true));
});


it('can delete a product', function () {

    $product = Product::factory()->create();

    $this->productService->shouldReceive('delete')
        ->once()
        ->andReturnUsing(fn($product) => $product->delete()); // forxo il delete col l'uso del mock

    $response = $this->deleteJson(route('api.products.destroy', $product->id));

    $response->assertOk();

    $this->assertDatabaseMissing('products', ['id' => $product->id]);
});
