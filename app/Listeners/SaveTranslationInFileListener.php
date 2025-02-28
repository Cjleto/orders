<?php

namespace App\Listeners;

use App\Events\SaveTranslationInFile;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaveTranslationInFileListener implements ShouldQueue
{
    use InteractsWithQueue;

    public $queue = 'trans-in-file';

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SaveTranslationInFile $event): void
    {
        $model = $event->model;
        $coppiaChiaveValore = $event->coppiaChiaveValore;
        $lang = $event->lang;

        $model->setTranslatedValue($coppiaChiaveValore, $lang);

        activity()
            ->performedOn($model)
            ->event('job_translation_saved')
            ->withProperties(['field' => $coppiaChiaveValore, 'lang' => $lang])
            ->log('Listener: Translation saved in file');
    }
}
