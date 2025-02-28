<?php

namespace App\Livewire;

use Debugbar;
use Livewire\Component;
use App\Enums\LanguageEnum;
use Livewire\Attributes\On;
use App\Helpers\LivewireSwal;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Session;
use Livewire\Attributes\Computed;
use App\Events\SaveTranslationInFile;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;
use Barryvdh\Debugbar\Twig\Extension\Debug;
use Livewire;

class TranslationShowList extends Component
{
    public Model $model;
    public array $translations;
    public array $enableTranslateButton;
    public bool $enableSaveButton = false;
    public array $modified = [];
    public bool $isTranslatingLive = false;


    public function mount()
    {
        $this->calculateTransArray();

        //dd($this->translations);
    }

    public function calculateTransArray()
    {
        $availableLanguages = LanguageEnum::cases();
        $translablableFields = $this->model->getTranslatableFields();
        foreach ($availableLanguages as $lang) {
            foreach ($translablableFields as $field) {

                $this->translations[$lang->value][$field] = $this->model->getTranslatedValue($field, $lang->value) ?? '';
                $this->enableTranslateButton[$lang->value][$field] = !$this->model->translationExists($field, $lang->value);
            }
        }
    }


    #[Computed]
    public function availableLanguage()
    {
        return LanguageEnum::cases();
    }

    public function updatedTranslations($text, $key)
    {
        // $key contiene ad esempio en.description
        [$lang, $field] = explode('.', $key);
        Debugbar::info("txetkey",$text, $field);
        $this->enableTranslateButton[$lang][$field] = strlen($this->translations[$lang][$field]) > 0;
        $this->enableSaveButton = true;

        Debugbar::info("A: " . (string) $this->model->translationExists($field, $lang));
        Debugbar::info("B: " . $this->model->getTranslatedValue($field, $lang));
        Debugbar::info($text);

        $this->modified[$lang][$field] = $this->model->translationExists($field, $lang) && ($this->model->getTranslatedValue($field, $lang) !== $text);
        /* Debugbar::info($this->model->getTranslatedValue($field, $lang)); */
        Debugbar::info($this->modified);
    }

    public function translateLive($lang, $field)
    {

        $this->isTranslatingLive = true;
        $textToTranslate = $this->translations[$lang][$field];

        if (empty($textToTranslate) || strlen($textToTranslate) > 250) {
            LivewireSwal::make($this)
                ->toast()
                ->error()
                ->setParams([
                    'title' => 'Errore!',
                    'text' => 'Il testo da tradurre deve essere compreso tra 1 e 250 caratteri.',
                    'dontClose' => true
                ])
                ->fireSwalEvent();
            $this->isTranslatingLive = false;
            return;
        }

        $translator = app('App\Interfaces\TranslatorInterface');

        $newText = $translator->translate('it', $lang, $textToTranslate);
        $this->translations[$lang][$field] = $newText;
        $this->isTranslatingLive = false;
        $this->enableSaveButton = true;
    }

    public function save()
    {
        // $lang = "en"
        // $fields = ['name' => 'ciao', 'description' => 'ciao']
        foreach ($this->translations as $lang => $coppiaChiaveValore) {

            event(new SaveTranslationInFile($this->model, $coppiaChiaveValore, $lang));

            /* $this->model->setTranslatedValue(
                translations: $fields,
                locale: $lang
            ); */
            /* foreach ($fields as $field => $text) {
                $this->translations[$lang][$field] = $text;
            } */
        }

        $this->enableSaveButton = false;
        $this->modified = [];


        LivewireSwal::make($this)
            ->success()
            ->setParams([
            'title' => 'Successo!',
            'text' => 'Setting salvato con successo.',
            'dontClose' => true
            ])
            ->fireSwalEvent();
    }

    public function render()
    {


        return view('livewire.translation-show-list');
    }
}
