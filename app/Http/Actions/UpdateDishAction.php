<?php

namespace App\Http\Actions;

use Exception;
use App\Models\Dish;
use App\Http\Dtos\DishDto;
use Illuminate\Support\Facades\DB;
use App\Events\TranslatableUpdatedEvent;
use App\Http\Services\CompanyService;
use App\Interfaces\TranslatorInterface;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class UpdateDishAction
{

    private TranslatorInterface $translator;

    public function __construct()
    {
        $this->translator = app(TranslatorInterface::class);
    }

    public function handle(DishDto $dishDto): Dish
    {
        try {

            // Ritorna il Dish creato
            $dish = DB::transaction(function () use ($dishDto) {
                $dish = Dish::findOrFail($dishDto->id);
                $dish->name = $dishDto->name;
                $dish->description = $dishDto->description;
                $dish->price = $dishDto->price;
                $dish->category_id = $dishDto->category_id;
                $dish->sub_category_id = $dishDto->sub_category_id;
                //$dish->order = $dishDto->order; settato in fase di create dal trait
                $dish->is_visible = $dishDto->is_visible;

                // check if dish description is changed

                // Salva il modello
                $dish->save();

                // Aggiungi la media se esiste
                if ($dishDto->photo && $dishDto->photo instanceof TemporaryUploadedFile) {
                    $dish->addMedia($dishDto->photo)->toMediaCollection('photo');
                }

                // Ritorna il dish creato all'interno della closure
                return $dish;
            });

            (new CompanyService)->forgetMenuMap($dish->category->company);

            // TODO gestire le chiavi da tradurre
            if ($dish->wasChanged('description')) {
                event(new TranslatableUpdatedEvent($dish, 'description'));
                info('Traduzione creata');
            } else {
                info('Traduzione non creata');
            }


            return $dish;
        } catch (Exception $e) {

            // Qui viene gestito il rollback automatico
            // Puoi loggare l'errore o gestirlo in qualche modo
            \Log::error('Errore durante la creazione del piatto: ' . $e->getMessage());

            // Puoi lanciare un'eccezione personalizzata o gestire l'errore come preferisci
            throw new \Exception('Transazione fallita e rollback effettuato. Dettaglio errore: ' . $e->getMessage());
        }
    }


   /*  private function createTranslations(Dish $dish): void
    {
        $langDest = ['en','fr','de'];
        // Salva le traduzioni

        $fields = [ 'description'];
        foreach ($fields as $field) {
            foreach ($langDest as $lang) {
                $traduzione = $this->translator->translate(config('app.locale'), $lang, $dish->$field);
                $dish->translations()->updateOrCreate(
                    [
                        'locale' => $lang,
                        'field' => $field
                    ],
                    [
                        'value' => $traduzione
                    ]
                );
            }


        }

    } */
}
