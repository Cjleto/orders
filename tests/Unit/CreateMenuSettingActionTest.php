<?php

use Tests\TestCase;
use App\Models\Company;
use App\Models\MenuSetting;
use App\Http\Dtos\MenuSettingDto;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Actions\CreateMenuSettingAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;



beforeEach(function () {
    $this->action = new CreateMenuSettingAction();
});

// Test per la creazione di un MenuSetting
it('creates a menu setting', function () {


    $company = Company::factory()->create();

    $dto = new MenuSettingDto([
        'company_id' => $company->id,
        'primary_color' => '#FF5733',
        'secondary_color' => '#C70039',
        'tertiary_color' => '#FFC107',
        'quaternary_color' => '#FF5722',
        'title' => 'My Menu',
        'template' => 'template1',
        'selectedFont' => 'Arial',
    ]);

    $menuSetting = $this->action->handle($dto);

    expect($menuSetting)->toBeInstanceOf(MenuSetting::class)
        ->and($menuSetting->company_id)->toEqual($company->id)
        ->and($menuSetting->primary_color)->toEqual('#FF5733')
        ->and($menuSetting->secondary_color)->toEqual('#C70039')
        ->and($menuSetting->tertiary_color)->toEqual('#FFC107')
        ->and($menuSetting->quaternary_color)->toEqual('#FF5722')
        ->and($menuSetting->title)->toEqual('My Menu');
});

// Test per l'aggiornamento di un MenuSetting esistente
it('updates a menu setting if it exists', function () {

    $company = Company::factory()->create();

    // Creare un MenuSetting per testare l'aggiornamento
    MenuSetting::create([
        'company_id' => $company->id,
        'primary_color' => '#FF5733',
        'secondary_color' => '#C70039',
        'tertiary_color' => '#FFC107',
        'quaternary_color' => '#FF5722',
        'title' => 'Old Menu',
        'template' => 'template1',
        'selected_font' => 'Arial',
    ]);

    $dto = new MenuSettingDto([
        'company_id' => $company->id,
        'primary_color' => '#123456',
        'secondary_color' => '#654321',
        'tertiary_color' => '#FFC107',
        'quaternary_color' => '#FF5722',
        'title' => 'Updated Menu',
        'template' => 'template2',
        'selectedFont' => 'Helvetica',
    ]);

    $menuSetting = $this->action->handle($dto);

    expect($menuSetting->company_id)->toEqual($company->id)
        ->and($menuSetting->primary_color)->toEqual('#123456')
        ->and($menuSetting->secondary_color)->toEqual('#654321')
        ->and($menuSetting->tertiary_color)->toEqual('#FFC107')
        ->and($menuSetting->quaternary_color)->toEqual('#FF5722')
        ->and($menuSetting->title)->toEqual('Updated Menu');
});

// Test per la gestione di un'eccezione
it('throws an exception if something goes wrong', function () {

    $company = Company::factory()->create();

    $dto = new MenuSettingDto([
        'company_id' => $company->id,
        'primary_color' => '#FF5733',
        'secondary_color' => '#C70039',
        'tertiary_color' => '#FFC107',
        'quaternary_color' => '#FF5722',
        'title' => 'My Menu',
        'template' => 'template1',
        'selectedFont' => 'Arial',
    ]);

    DB::shouldReceive('transaction')
        ->andThrow(new \Exception('Something went wrong'));

    $this->action->handle($dto);
})->throws(\Exception::class, 'Something went wrong');
