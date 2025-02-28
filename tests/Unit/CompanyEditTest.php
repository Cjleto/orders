<?php

use App\Models\User;
use Livewire\Livewire;
use App\Models\Company;
use App\Enums\CompanyType;
use App\Livewire\CompanyEdit;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Database\Seeders\PermissionsRolesSeeder;

beforeEach(function () {
    $this->seed(PermissionsRolesSeeder::class);
});

it('renders the component', function () {
    $user = User::factory()->manager()->create();
    $company = Company::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user);

    Livewire::test(CompanyEdit::class, ['company' => $company])
        ->assertSet('name', $company->name)
        ->assertSet('address', $company->address)
        ->assertSet('description', $company->description)
        ->assertSet('slug', $company->slug)
        ->assertSet('user_id', $company->user_id)
        ->assertSet('type', $company->type)
        ->assertSet('google_review_link', $company->google_review_link)
        ->assertSet('facebook_link', $company->facebook_link)
        ->assertSet('instagram_link', $company->instagram_link)
        ->assertSet('site_link', $company->site_link)
        ->assertViewIs('livewire.company-edit');
});

it('validates required fields', function () {
    $user = User::factory()->create();
    $company = Company::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user);

    Livewire::test(CompanyEdit::class, ['company' => $company])
        ->set('name', '')
        ->set('description', '')
        ->set('address', '')
        ->set('slug', '')
        ->set('type', '')
        ->call('save')
        ->assertHasErrors([
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
            'slug' => 'required',
            'type' => 'required',
        ]);
});

it('validates logo upload', function () {
    $user = User::factory()->create();
    $company = Company::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user);

    Storage::fake('public');

    $file = UploadedFile::fake()->image('logo.jpg')->size(3000); // 3MB

    Livewire::test(CompanyEdit::class, ['company' => $company])
        ->set('newLogo', $file)
        ->call('save')
        ->assertHasErrors(['newLogo' => 'max']);
});

