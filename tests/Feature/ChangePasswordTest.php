<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Database\Seeders\PermissionsRolesSeeder;

it('can change password', function () {

    $this->withoutExceptionHandling();

    // call PermissionsRolesSeeder seeder
    $this->seed(PermissionsRolesSeeder::class);

    $user = User::factory()->admin()->create();

    $response = $this->actingAs($user)
        ->put(route('users.update', $user), [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'Newpassword2024!',
            'role' => $user->roles->first()->name,
        ]);

        $response->assertStatus(302);

        $this->assertTrue(Hash::check('Newpassword2024!', $user->fresh()->password));
});

it('fails validation when password is invalid', function () {

    // Call PermissionsRolesSeeder seeder
    $this->seed(PermissionsRolesSeeder::class);

    $user = User::factory()->admin()->create();

    // Esegui la richiesta con una password non valida (es. troppo corta)
    $response = $this->actingAs($user)
        ->put(route('users.update', $user), [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'a', // Password non valida
            'role' => $user->roles->first()->name,
        ]);

    $response->assertStatus(302);

    // Verifica che ci sia un errore di validazione per il campo 'password'
    $response->assertSessionHasErrors(['password']);
    $response->assertSessionHasErrors('password', 'The password must be at least 8 characters.');

});
