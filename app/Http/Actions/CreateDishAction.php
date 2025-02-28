<?php

namespace App\Http\Actions;

use Exception;
use App\Models\Dish;
use App\Http\Dtos\DishDto;
use Illuminate\Support\Facades\DB;
use App\Http\Services\CompanyService;
use App\Events\TranslatableUpdatedEvent;

class CreateDishAction
{
    public function handle(DishDto $dishDto): Dish
    {
        try {
            // Ritorna il Dish creato
            $dish = DB::transaction(function () use ($dishDto) {
                $dish = new Dish();
                $dish->name = $dishDto->name;
                $dish->description = $dishDto->description;
                $dish->price = $dishDto->price;
                $dish->category_id = $dishDto->category_id;
                $dish->sub_category_id = $dishDto->sub_category_id;
                $dish->order = $dishDto->order;
                $dish->is_visible = $dishDto->is_visible;

                // Salva il modello
                $dish->save();

                // Aggiungi la media se esiste
                if ($dishDto->photo) {
                    $dish->addMedia($dishDto->photo)->toMediaCollection('photo');
                }

                (new CompanyService)->forgetMenuMap($dish->category->company);

                // Ritorna il dish creato all'interno della closure
                return $dish;
            });

            return $dish;
        } catch (Exception $e) {
            // Qui viene gestito il rollback automatico
            // Puoi loggare l'errore o gestirlo in qualche modo
            \Log::error('Errore durante la creazione del piatto: ' . $e->getMessage());

            // Puoi lanciare un'eccezione personalizzata o gestire l'errore come preferisci
            throw new \Exception('Transazione fallita e rollback effettuato. Dettaglio errore: ' . $e->getMessage());
        }
    }
}
