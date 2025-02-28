<?php

namespace Database\Factories;

use App\Models\Dish;
use App\Enums\IsVisible;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PartialPrice>
 */
class PartialPriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dish_id' => Dish::factory(),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'label' => $this->faker->word,
        ];
    }

    public function visible()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_visible' => IsVisible::VISIBLE,
            ];
        });
    }
}
