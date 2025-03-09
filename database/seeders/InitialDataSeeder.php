<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\DTO\OrderProductDTO;
use App\Services\OrderService;
use Illuminate\Database\Seeder;

class InitialDataSeeder extends Seeder
{

    public function __construct(private OrderService $orderService) {}

    public function run(): void
    {

        User::factory()->admin()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('Qwerty7-'),
        ]);

        Customer::factory()->count(10)->create();

        $products = Product::factory()->count(10)->create();

        Order::factory()->randomStatus()->randomCreateDate()->count(10)->create()->each(function ($order) {
            // Prendi un numero random di prodotti (tra 1 e 4)
            $products = \App\Models\Product::inRandomOrder()->take(rand(1, 4))->get();

            $orderProducts = $products->map(function ($product) {
                $orderProductObj = new OrderProductDTO(
                    product_id: $product->id,
                    product_name: $product->name,
                    quantity: rand(1, 5),
                    product_price: $product->price
                );

                return $orderProductObj->toArray();
            });

            // Associa i prodotti all'ordine con i dati della pivot
            $this->orderService->storeOrderItems($order, $orderProducts);
            $this->orderService->calculateTotal($order);
        });
    }
}
