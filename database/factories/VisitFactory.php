<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visit>
 */
class VisitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'session_id' => $this->faker->uuid,
            'ip_address' => $this->faker->ipv4,
            'user_agent' => $this->faker->userAgent,
            'route' => $this->faker->slug()
        ];
    }
}
