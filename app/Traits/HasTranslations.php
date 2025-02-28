<?php

namespace App\Traits;

use App\Enums\LanguageEnum;
use Illuminate\Support\Facades\File;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Database\Eloquent\Model;
use App\Events\TranslatableUpdatedEvent;

trait HasTranslations
{

    protected static function booted(): void
    {

        static::created(function (Model $model) {

            foreach ($model->getTranslatableFields() as $field) {
                event(new TranslatableUpdatedEvent($model, $field));
            }

        });

        static::deleted(function (Model $model) {
            $model->unsetTranslations();
        });
    }

    public function getTranslatedValue (string $field, string $locale = null): string
    {
        $locale = $locale ?? session('app_locale', config('app.locale'));

        // Percorso del file di traduzione, per esempio: resources/lang/{user_id}/{locale}.php o .json
        $translationPath = base_path("lang/{$this->getTranslationPath()}/{$locale}.php");


        // Verifica se il file di traduzione esiste
        if (file_exists($translationPath)) {
            // Carica il file di traduzione
            $translations = include $translationPath;
            // Restituisci il nome tradotto se esiste nel file, altrimenti usa il campo `name` del database
            return isset($translations[$this->$field]) ? $translations[$this->$field] : (string)$this->$field;
        }

        // Se il file di traduzione non esiste, usa il campo `$field` originale
        return (string)$this->$field;
    }

    public function translationExists (string $field, string $locale = null): bool
    {
        $locale = $locale ?? session('app_locale', config('app.locale'));

        // Percorso del file di traduzione, per esempio: resources/lang/{user_id}/{locale}.php o .json
        $translationPath = base_path("lang/{$this->getTranslationPath()}/{$locale}.php");
        //Debugbar::info($translationPath);

        // Verifica se il file di traduzione esiste
        if (file_exists($translationPath)) {
            // Carica il file di traduzione
            $translations = include $translationPath;
            // Restituisci il nome tradotto se esiste nel file, altrimenti usa il campo `name` del database
            return isset($translations[$this->$field]);
        }

        return false;
    }


    /**
     * @param array<string, string> $translations Array associativo con i campi da tradurre come chiavi e i valori tradotti come valori
     * Esempio:
     *  [
     *      "description" => "EEEENToasted bread with tomato and basil",
     *      "name" => "zxczxczxcc"
     *  ]
     * @param string $locale Locale per cui salvare le traduzioni
     */
    public function setTranslatedValue (array $translations, string $locale): void
    {

        $locale = $locale ?? session('app_locale', config('app.locale'));

        $basePath = base_path("lang/{$this->getTranslationPath()}");
        $translationPath = "{$basePath}/{$locale}.php";

        // Carica le traduzioni esistenti, se il file esiste
        $existingTranslations = File::exists($translationPath) ? File::getRequire($translationPath) : [];

        // devo ottenere unarray con chiave il valore originale da tradurre dal model, e come valore il nuovo valore presente in tranlations[field]
        // $translations = array:2
        //      "description" => "EEEENToasted bread with tomato and basil"
        //      "name" => "zxczxczxcc"
        // ];
        $datatToInsert = [];
        foreach($translations as $field => $value) {
            $datatToInsert[$this->$field] = $value;
        }

        //dd($existingTranslations, $datatToInsert);
        // Unisci le nuove traduzioni con quelle esistenti
        $updatedTranslations = array_merge($existingTranslations, $datatToInsert);

        // Assicurati che la directory esista
        File::ensureDirectoryExists($basePath);

        // Salva le traduzioni aggiornate nel file
        File::put($translationPath, '<?php return ' . var_export($updatedTranslations, true) . ';');
    }

    public function saveTranslations (string $field, array $languages = null): bool
    {

        try
        {
            if(is_null($languages)) {
                $langDest = LanguageEnum::cases();
            }

            $translator = app('App\Interfaces\TranslatorInterface');

            foreach ($langDest as $lang) {
                if(is_null($this->$field) || empty($this->$field)) {
                    continue;
                }
                $traduzione = $translator->translate('it', $lang->value, $this->$field);
                /* $this->translations()->updateOrCreate(
                    [
                        'locale' => $lang->value,
                        'field' => $field
                    ],
                    [
                        'value' => $traduzione
                    ]
                ); */

                $this->setTranslatedValue(
                    translations: [
                        $field => $traduzione
                    ],
                    locale: $lang->value
                );
            }
            return true;
        } catch (\Exception $e) {
            dd($e);
            return false;
        }
    }

    public function unsetTranslations ()
    {
        $locale = session('app_locale', config('app.locale'));
        $translationPath = base_path("lang/{$this->getTranslationPath()}/{$locale}.php");

        $languages = LanguageEnum::cases();

        foreach ($languages as $lang) {
            $translationPath = base_path("lang/{$this->getTranslationPath()}/{$lang->value}.php");
            if (file_exists($translationPath)) {
                File::delete($translationPath);
            }
            // delete folder if empty
            $folder = base_path("lang/{$this->getTranslationPath()}");
            if (count(File::files($folder)) == 0) {
                File::deleteDirectory($folder);
            }
        }

    }
}
