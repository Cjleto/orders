<?php

namespace App\Providers;

use App\Events\TranslatableUpdatedEvent;
use App\Listeners\TranslateFieldsListener;
use Event;
use Illuminate\Support\ServiceProvider;

class TranslationServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(
            'App\Interfaces\TranslatorInterface',
            'App\Services\GoogleTranslator'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Event::listen(
            TranslatableUpdatedEvent::class,
            TranslateFieldsListener::class
        );
    }
}
