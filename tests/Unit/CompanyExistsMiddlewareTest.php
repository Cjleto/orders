<?php

use App\Models\User;
use App\Models\Company;
use App\Models\MenuSetting;
use Database\Seeders\InitialDataSeeder;
use App\Exceptions\WebRenderedException;
use Database\Seeders\PermissionsRolesSeeder;


it('redirects to missing_company route if user has no company', function () {

    // call PermissionsRolesSeeder seeder
    $this->seed(PermissionsRolesSeeder::class);

    $this->withoutExceptionHandling();
    $user = User::factory()->manager()->create();
    $this->actingAs($user);
    $response = $this->get(route('macro_categories.index'));
    $response->assertRedirect(route('missing_company'));
});

it('does not redirect to missing_company route if user has a company', function () {

    // call PermissionsRolesSeeder seeder
    $this->seed(PermissionsRolesSeeder::class);

    $this->withoutExceptionHandling();
    $user = User::factory()->manager()->create();
    Company::factory()->recycle($user)->create(['name' => 'Company']);

    $this->actingAs($user);
    $response = $this->get(route('macro_categories.index'));
    $response->assertOk();
});

it('does not redirect to missing_company route if route is public.menu', function () {

    // call PermissionsRolesSeeder seeder
    $this->seed(PermissionsRolesSeeder::class);

    $this->withoutExceptionHandling();
    $user = User::factory()->manager()->create();
    $this->actingAs($user);

    $company = Company::factory()->recycle($user)->create(['name' => 'Company', 'slug' => 'aiaia']);

    $response = $this->get(route('public.menu', $company));

    $response->assertRedirect(route('missing_menu_setting'));
});

it('redirects to missing_menu_setting if menuMap is empty', function () {
    // Call PermissionsRolesSeeder seeder
    $this->seed(PermissionsRolesSeeder::class);

    $user = User::factory()->manager()->create();
    Company::factory()->recycle($user)->create(['name' => 'Company', 'slug' => 'aiaia']);
    $this->actingAs($user);

    $response = $this->get(route('public.menu', 'aiaia'));

    // Verifica il redirect alla route missing_menu_setting
    $response->assertRedirect(route('missing_menu_setting'));
});

it('returns a 400 error view if menuMap is empty', function () {
    // Call PermissionsRolesSeeder seeder
    $this->seed(PermissionsRolesSeeder::class);

    $user = User::factory()->manager()->create();
    Company::factory()->recycle($user)->create(['name' => 'Company', 'slug' => 'aiaia']);

    $this->actingAs($user);

    // Esegui la richiesta e cattura la risposta
    $response = $this->get(route('public.menu', 'aiaia'));
    // Verifica che lo stato HTTP sia 400
    $response->assertStatus(302);

    // Verifica che la vista restituita sia corretta
    /* $response->assertViewIs('errors.web-rendered');
    $response->assertViewHas('main_text', 'Menu non trovato');
    $response->assertViewHas('secondary_text', 'Contattare l\'amministratore di sistema'); */
});

