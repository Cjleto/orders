<?php

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\DTO\OrderStoreApiDTO;
use Illuminate\Http\Response;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\OrderResource;
use App\Actions\Order\CreateOrderApiAction;
use App\Enums\OrderStatus;
use App\Http\Requests\StoreOrderApiRequest;
use Database\Seeders\PermissionsRolesSeeder;
use App\Http\Controllers\Api\V1\OrderController;
use App\Models\OrderProduct;

beforeEach(function () {

    $this->seed(PermissionsRolesSeeder::class);
    $this->orderService = mock(OrderService::class);
    $this->app->instance(OrderService::class, $this->orderService);
    $this->createOrderApiAction = mock(CreateOrderApiAction::class);


    $this->user = User::factory()->admin()->create();
    $this->actingAs($this->user);
});

it('can list all orders', function () {

    $orders = Order::factory()->count(3)->create();

    $this->orderService->shouldReceive('getWithSortingAndIncludes')
        ->once()
        ->andReturn($orders);

    $response = $this->getJson(route('api.orders.index'));

    $response->assertStatus(Response::HTTP_OK)
        ->assertJson(OrderResource::collection($orders)->response()->getData(true));
});

it('creates an order and returns a valid JSON response', function () {
    // Crea un cliente e dei prodotti nel database di test
    $customer = Customer::factory()->create();
    $product1 = Product::factory()->create(['price' => 10.00]);
    $product2 = Product::factory()->create(['price' => 20.00]);

    // Dati della richiesta
    $requestData = [
        'customer_id' => $customer->id,
        'products' => [
            ['product_id' => $product1->id, 'quantity' => 2],
            ['product_id' => $product2->id, 'quantity' => 1],
        ],
    ];

    // Esegui la richiesta POST
    $response = $this->postJson(route('api.orders.store'), $requestData);

    // Verifica che la risposta abbia status code 201 (Created)
    $response->assertStatus(201);

    // Decodifica la risposta JSON
    $responseData = $response->json();

    // Verifica che l'ordine sia stato creato nel database
    $createdOrder = Order::find($responseData['data']['id']);
    expect($createdOrder)->not->toBeNull();
    expect($createdOrder->customer_id)->toBe($customer->id);
    expect($createdOrder->total)->toBe(40.00);

    // Verifica che la risposta contenga i dati corretti
    expect($responseData['success'])->toBeTrue();
    expect($responseData['data']['status'])->toBe('in elaborazione');
    expect($responseData['data']['total'])->toBe(40);
    expect($responseData['data']['formatted_total'])->toBe('40,00 €');
});

it('can show a single order', function () {

    $order = Order::factory()->create();

    $response = $this->getJson(route('api.orders.show', $order->id));

    $response->assertOk()
        ->assertJson(OrderResource::make($order)->response()->getData(true));
});

it('can delete an order', function () {

    $order = Order::factory()->create();

    $this->orderService->shouldReceive('delete')
        ->once()
        ->with($order->id);

    $response = $this->deleteJson(route('api.orders.destroy', $order->id));

    $response->assertOk();

    $order->delete();

    expect(Order::find($order->id))->toBeNull();
});


it('can retrieve products in order show', function(){
    $order = Order::factory()->create();
    $product = Product::factory()->create();
/*     $order->products()->attach($product->product_id, [
        'quantity' => $product->quantity,
        'product_name' => $product->product_name,
        'product_price' => $product->product_price
    ]); */

    $orderProduct = OrderProduct::create([
        'order_id' => $order->id,
        'product_id' => $product->id,
        'quantity' => 10,
        'product_name' => $product->name,
        'product_price' => $product->price
    ]);

    $response = $this->getJson(route('api.orders.show', $order->id) . '?include=customer,products');

    $response->assertOk()
        ->assertJsonPath('data.products.0.id', $product->id);
});
