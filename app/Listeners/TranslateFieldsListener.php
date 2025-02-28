<?php

namespace App\Listeners;


use App\Enums\LanguageEnum;
use App\Interfaces\TranslatorInterface;
use App\Events\TranslatableUpdatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;


class TranslateFieldsListener implements ShouldQueue
{

    use InteractsWithQueue;

    private $enabled;
    public $queue = 'trans-in-file';


    public function __construct(protected TranslatorInterface $translator)
    {
        $this->enabled = config('myconst.translate_enabled');
    }

    /**
     * Handle the event.
     */
    public function handle(TranslatableUpdatedEvent $event): void
    {

        $model = $event->model;
        $field = $event->field;

        $created = $model->saveTranslations($field);

        activity()
            ->performedOn($model)
            ->event('job_translation_fields_saved')
            ->withProperties(['field' => $field])
            ->log('Listener: Translation saved in file');
    }

    /* public function shouldQueue(TranslatableUpdatedEvent $event)
    {
        return $this->enabled;
    } */
}
