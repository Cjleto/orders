<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    protected $model = User::class;
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'theme' => 'light',
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    public function admin()
    {
        return $this->afterCreating(function (User $user) {
            // Assegna il ruolo admin all'utente
            $adminRole = Role::where('name', 'admin')->first();
            if ($adminRole) {
                $user->assignRole($adminRole);
            }
        });
    }

    public function manager()
    {
        return $this->afterCreating(function (User $user) {
            // Assegna il ruolo manager all'utente
            $managerRole = Role::where('name', 'manager')->first();
            if ($managerRole) {
                $user->assignRole($managerRole);
            }
        });
    }
}
