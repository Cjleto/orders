<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\OrderStatus;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'status' => $this->faker->randomElement(OrderStatus::cases()),
            'total' => $this->faker->randomFloat(2, 10, 500),
        ];
    }


    public function configure(): static
    {
        dd('configure');
        return $this->afterCreating(function (Order $order) {
            \Log::info('Order created:', ['order_id' => $order->id]);

            $products = Product::inRandomOrder()->take(2)->get();
            \Log::info('Products selected:', ['products' => $products]);

            foreach ($products as $product) {
                $order->products()->attach($product->id, [
                    'quantity' => 5,
                    'product_name' => $product->name,
                    'product_price' => $product->price,
                ]);
            }
            \Log::info('Products attached to order:', ['order_id' => $order->id]);
        });
    }

    public function randomCreateDate()
    {
        return $this->state([
            'created_at' => $this->faker->dateTimeBetween('-1 week', 'now'),
        ]);
    }

    public function in_elaborazione()
    {
        return $this->state([
            'status' => OrderStatus::IN_ELABORAZIONE->value,
        ]);
    }

    public function spedito()
    {
        return $this->state([
            'status' => OrderStatus::SPEDITO->value,
        ]);
    }

    public function consegnato()
    {
        return $this->state([
            'status' => OrderStatus::CONSEGNATO->value,
        ]);
    }
}
