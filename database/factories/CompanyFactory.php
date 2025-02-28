<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Company;
use App\Enums\CompanyType;
use Illuminate\Support\Str;
use App\Enums\CompanyStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $name = $this->faker->name;

        $statuses = array_map(fn($case) => $case->value, CompanyStatus::cases());

        return [
            'name' => $name,
            'description' => $this->faker->sentence,
            'address' => $this->faker->address,
            'slug' => Str::slug($name),
            'status' => $this->faker->randomElement($statuses),
            'expiration_date' => $this->faker->dateTimeBetween('1 week', '+1 year'),
            'user_id' => User::factory()->manager(),
            'type' => $this->faker->randomElement(CompanyType::cases()),
            'google_review_link' => $this->faker->url,
            'facebook_link' => $this->faker->url,
            'instagram_link' => $this->faker->url,
            'site_link' => $this->faker->url,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Company $company) {
            // Aggiungere un logo tramite Media Library
            $company->addMedia(public_path('img/nologo.jpeg'))
                ->preservingOriginal()// percorso del file logo
                ->toMediaCollection('logo');


        });
    }

    public function active()
    {
        return $this->state(fn (array $attributes) => [
            'status' => CompanyStatus::ACTIVE->value,
        ]);
    }

    public function inactive()
    {
        return $this->state(fn (array $attributes) => [
            'status' => CompanyStatus::INACTIVE->value,
        ]);
    }

    public function suspended()
    {
        return $this->state(fn (array $attributes) => [
            'status' => CompanyStatus::SUSPENDED->value,
        ]);
    }
}
