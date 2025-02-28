<?php

namespace Database\Factories;

use App\Enums\IsVisible;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'category_id' => Category::factory(),
            'is_visible' => $this->faker->randomElement(IsVisible::cases()),
            'order' => null,
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
