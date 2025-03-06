<?php

use App\Models\User;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;
use Database\Seeders\PermissionsRolesSeeder;

beforeEach(function () {

    $this->seed(PermissionsRolesSeeder::class);
    // Mock dei servizi
    $this->userService = mock(UserService::class);
    $this->roleService = mock(RoleService::class);

    $this->user = User::factory()->admin()->create();
    $this->role = Role::where('name', 'admin')->first();
    $this->actingAs($this->user);
});

it('index returns a view with users', function () {


    // Mock del metodo paginate
    $this->userService->shouldReceive('paginate')->andReturn(User::paginate(10));

    // Chiamata al metodo index
    $response = $this->get(route('users.index'));

    // Verifica che la risposta sia una view e che contenga gli utenti
    $response->assertStatus(Response::HTTP_OK);
    $response->assertViewIs('users.index');
    $response->assertViewHas('users');
});

it('create returns a view with roles', function () {
    // Mock del metodo all
    $this->roleService->shouldReceive('all')->andReturn(Role::all());

    // Chiamata al metodo create
    $response = $this->get(route('users.create'));

    // Verifica che la risposta sia una view e che contenga i ruoli
    $response->assertStatus(Response::HTTP_OK);
    $response->assertViewIs('users.create');
    $response->assertViewHas('roles');
});

it('store creates a user and redirects to index', function () {
    // Mock del metodo store
    $this->userService->shouldReceive('store')->andReturn($this->user);

    // Dati fittizi per la richiesta
    $data = [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'role' => $this->role->name,
    ];

    // Chiamata al metodo store
    $response = $this->post(route('users.store'), $data);

    // Verifica che la risposta sia un redirect e che contenga un messaggio di successo
    $response->assertStatus(Response::HTTP_FOUND);
    $response->assertRedirect(route('users.index'));

});

it('edit returns a view with user and roles', function () {
    // Mock del metodo all
    $this->roleService->shouldReceive('all')->andReturn(Role::all());

    // Chiamata al metodo edit
    $response = $this->get(route('users.edit', $this->user));

    // Verifica che la risposta sia una view e che contenga l'utente e i ruoli
    $response->assertStatus(Response::HTTP_OK);
    $response->assertViewIs('users.edit');
    $response->assertViewHas('user', $this->user);
    $response->assertViewHas('roles');
});

it('update updates a user and redirects to index', function () {
    // Mock del metodo update
    $this->userService->shouldReceive('update')->andReturn($this->user);

    // Dati fittizi per la richiesta
    $data = [
        'name' => 'Updated User',
        'email' => 'updated@example.com',
        'role' => $this->role->name,
    ];

    // Chiamata al metodo update
    $response = $this->put(route('users.update', $this->user), $data);

    // Verifica che la risposta sia un redirect e che contenga un messaggio di successo
    $response->assertStatus(Response::HTTP_FOUND);
    $response->assertRedirect(route('users.index'));

});

it('destroy deletes a user and redirects to index', function () {
    // Mock del metodo delete
    $this->userService->shouldReceive('delete')->andReturn(true);

    // Chiamata al metodo destroy
    $response = $this->delete(route('users.destroy', $this->user));

    // Verifica che la risposta sia un redirect e che contenga un messaggio di successo
    $response->assertStatus(Response::HTTP_FOUND);
    $response->assertRedirect(route('users.index'));

});

it('toggleTheme toggles the user theme and redirects back', function () {
    // Autentica l'utente
    $this->actingAs($this->user);

    // Chiamata al metodo toggleTheme
    $response = $this->get(route('toggle.theme'));

    // Verifica che la risposta sia un redirect e che il tema sia stato aggiornato
    $response->assertStatus(Response::HTTP_FOUND);
    $response->assertRedirect();
    expect($this->user->fresh()->theme)->toBe('dark'); // o 'light' a seconda del tema iniziale
});
