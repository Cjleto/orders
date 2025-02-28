<?php

namespace Database\Factories;

use App\Enums\IsVisible;
use App\Models\Category;
use App\Models\MacroCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            'macro_category_id' => MacroCategory::factory(),
            'description' => $this->faker->sentence,
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
