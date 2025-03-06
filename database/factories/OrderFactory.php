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

    public function randomCreateDate()
    {
        return $this->state(function (array $attributes) {
            return [
                'created_at' => $this->faker->dateTimeBetween('-1 week', 'now'),
            ];
        });
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
