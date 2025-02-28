<?php

namespace App\Livewire;

use Livewire\Component;
use App\Enums\LanguageEnum;
use Livewire\Attributes\On;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\File;
use App\Events\SaveTranslationInFile;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Database\Eloquent\Model;


class TranslationsIndex extends Component
{
    public int $model_id;
    public $model;
    public array $translations;
    public array $enableTranslateButton;
    public bool $enableSaveButton = true;
    public array $modified = [];


    public function mount()
    {
        $this->model = $this->model::findOrFail($this->model_id);
        /* $this->calculateTransArray(); */

        //dd($this->translations);
    }

    public function calculateTransArray()
    {
        Debugbar::info('ricalcolo ' . time());
        $availableLanguages = LanguageEnum::cases();
        $translablableFields = $this->model->getTranslatableFields();
        foreach ($availableLanguages as $lang) {
            foreach ($translablableFields as $field) {
                $this->translations[$lang->value][$field] = $this->model->getTranslatedValue($field, $lang->value) ?? '';
            }
        }
    }


    #[Computed]
    public function availableLanguage()
    {
        return LanguageEnum::cases();
    }

    public function updatedTranslationsaa($text, $key)
    {
        // $fiel contiene ad esempio en.description
        [$lang, $field] = explode('.', $key);

        $this->modified[$lang][$field] = $this->model->translationExists($field, $lang) && ($this->model->getTranslatedValue($field, $lang) !== $text);
    }

    public function translateLive($lang, $field)
    {

        $textToTranslate = $this->translations[$lang][$field];
        $translator = app('App\Interfaces\TranslatorInterface');

        $newText = $translator->translate('it', $lang, $textToTranslate);
        $this->translations[$lang][$field] = $newText;
        Debugbar::info($newText);

    }

    public function aggiorna()
    {
        Debugbar::info('Salvataggio iniziato');

        // Procedura di salvataggio
        try {
            foreach ($this->translations as $lang => $coppiaChiaveValore) {
                /* $this->model->setTranslatedValue(
                    translations: $coppiaChiaveValore,
                    locale: $lang
                ); */

                event(new SaveTranslationInFile($this->model, $coppiaChiaveValore, $lang));

            }

            $this->enableSaveButton = false;
            $this->modified = [];

            Debugbar::info('Salvataggio completato con successo');
        } catch (\Exception $e) {
            Debugbar::error('Errore durante il salvataggio: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.translations-index');
    }


}
