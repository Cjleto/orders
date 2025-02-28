<?php

namespace App\Console\Commands;

use App\Models\Dish;
use App\Models\Company;
use App\Models\Category;
use App\Enums\LanguageEnum;
use App\Models\SubCategory;
use Illuminate\Console\Command;
use function Laravel\Prompts\pause;
use Illuminate\Support\Facades\App;
use function Laravel\Prompts\select;


class CreaTraduzioni extends Command
{
    protected $signature = 'crea:traduzioni';

    protected $description = 'Avvia il processo di traduzione per una specifica entità';

    public function handle()
    {

        $companies = Company::select('name', 'id')->get()->toArray();

        $companiesValues = array_column($companies, 'name', 'id');

        $company = select(
            label: 'Per quale company?',
            options: $companiesValues,
        );

        // get company by id from companies array
        //$company = array_search($company, $companiesValues);
        $this->info("Hai scelto l'entità $company");

        $company = Company::findOrFail($company);

        // get all dishes
        $macros = $company->macroCategories()->get();

        $categories = Category::whereIn('macro_category_id', $macros->pluck('id'))->get();

        $subCategories = SubCategory::whereIn('category_id', $categories->pluck('id'))->get();

        /* $dish = Dish::whereIn('category_id', $categories->keys())->pluck('name', 'id'); */
        $dishes = Dish::whereIn('category_id', $categories->pluck('id'))->get();

        if($dishes->count() == 0) {
            $this->info('Non ci sono piatti da tradurre');
            $this->info('Fine traduzione...');
            return;
        }



        // setta la lingua locale

        App::setLocale('it');

        $modelsToTranslate = [
            'MacroCategory' => $macros,
            'Category' => $categories,
            'SubCategory' => $subCategories,
            'Dish' => $dishes
        ];


        foreach ($modelsToTranslate as $model) {
            $this->handleModel($model);
        }



       /*  foreach ($dishes as $dish) {
            // verifico se esiste la traduzione
            foreach ($dish->getTranslatableFields() as $field) {

                foreach($langDisponibili as $lang){
                    $this->info("Lingua: $lang->value");

                    $exists = $dish->translationExists($field, $lang->value);
                    if($exists){
                        $this->info("{$dish->name} ha la traduzione per $field");
                        continue;
                    }

                    $this->info("{$dish->name} non ha le traduzioni per $field con lingua $lang->value");

                    //pause('Continua per il piatto con id: ' . $dish->id . ' e campo: ' . $field . ' e lingua: ' . $lang->value);


                    $created = $dish->saveTranslations($field);

                    $this->info($created ? "Traduzione creata per $field" : "Errore nella creazione della traduzione per $field");
                }




            }

        }
 */
        $this->info('Fine traduzione...');

    }

    private function handleModel($collection)
    {

        $langDisponibili = LanguageEnum::cases();
        foreach ($collection as $model) {
            foreach ($model->getTranslatableFields() as $field) {

                if (is_null($model->$field) || empty($model->$field)) {
                    pause('Il campo ' . $field . ' è vuoto per il model ' . class_basename($model) . ' con id: ' . $model->id);
                    continue;
                }

                foreach ($langDisponibili as $lang) {
                    $this->info("Lingua: $lang->value");

                    $exists = $model->translationExists($field, $lang->value);
                    if ($exists) {
                        $this->info("{$model->name} ha la traduzione per $field");
                        continue;
                    }

                    $this->info("{$model->name} non ha le traduzioni per $field con lingua $lang->value");

                    pause('Continua per il model '.class_basename($model).' con id: ' . $model->id . ' e campo: ' . $field . ' e lingua: ' . $lang->value);


                    $created = $model->saveTranslations($field);

                    if($created){
                        $msg = "Traduzione creata per $field";
                    } else {
                        $msg = "Errore nella creazione della traduzione per $field";
                    }

                    activity()
                        ->performedOn($model)
                        ->withProperties(['field' => $field, 'lang' => $lang->value])
                        ->log($msg);

                    $this->info($msg);
                }
            }
        }
    }
}
