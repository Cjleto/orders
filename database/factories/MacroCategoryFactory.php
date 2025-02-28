<?php

namespace Database\Factories;

use App\Models\Company;
use App\Enums\IsVisible;
use App\Http\Services\MacroCategoryService;
use App\Models\MacroCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MacroCategory>
 */
class MacroCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $macroService = new MacroCategoryService();

        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'company_id' => Company::factory(),
            'order' => null,
            'is_visible' => $this->faker->randomElement(IsVisible::cases()),
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
