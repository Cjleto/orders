<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class PeculiarityFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'icon' => 'shrimp',
        ];
    }
}
