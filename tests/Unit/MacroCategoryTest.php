<?php

use App\Models\Company;
use App\Models\MacroCategory;
use Illuminate\Support\Facades\Event;
use Illuminate\Database\Eloquent\Model;

it('automatically sets the order field if not provided', function () {

    Model::setEventDispatcher(app('events'));

    $company = Company::factory()->create();

    $maxOrder = 10;
    $countNew = 5;

    $initial = MacroCategory::factory()
        ->recycle($company)
        ->visible()
        ->create([
            'order' => $maxOrder,
        ]);


    // Crea un'istanza della macro-categoria senza specificare l'order
    $macroCategories = MacroCategory::factory()
        ->recycle($company)
        ->visible()
        ->count($countNew)
        ->create();

    $last = $macroCategories->last();

    // Verifica che l'ordine sia stato impostato automaticamente
    expect($last->order)->toBe($maxOrder + $countNew);
});
