<?php

use App\Models\Dish;
use App\Enums\LanguageEnum;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Event;
use App\Events\TranslatableUpdatedEvent;

it('should retrieve translations for a model', function () {

    $this->app->setLocale('it');

    $model = Dish::factory()->create([
        'name' => 'Pane tostato con pomodoro e basilico',
        'description' => 'Bruschetta',
    ]);

    $model->setTranslatedValue([
        'name' => 'breadasasasvcbvcb',
        'description' => null,
    ], 'en');

    $translated = $model->getTranslatedValue('name', 'en');
    expect($translated)->toBe('breadasasasvcbvcb');

    $translated = $model->getTranslatedValue('description', 'en');
    expect($translated)->toBe('Bruschetta');

});

it('should retrieve original description if translation is null', function () {
        $this->app->setLocale('it');

        $model = Dish::factory()->create([
            'name' => 'Pane tostato con pomodoro e basilico',
            'description' => 'Bruschetta',
        ]);

        $model->setTranslatedValue([
            'name' => 'breadasasasvcbvcb',
            'description' => null,
        ], 'en');


        $translated = $model->getTranslatedValue('description', 'en');
        expect($translated)->toBe('Bruschetta');
});

it('should retrieve translations from translator instance', function () {


    Context::add('enable_translation', true);

    // define conf locale
    $this->app->setLocale('it');

    /* $model = Dish::factory()->create([
        'name' => 'Pane tostato con pomodoro e basilico',
        'description' => 'Bruschetta',
    ]); */

    // get translator instance
    $translator = app('App\Interfaces\TranslatorInterface');

    // translate text
    $translated = $translator->translate('it', 'en', 'Ciao mondo');

    expect(strtolower($translated))->toBe('hello world');


});


