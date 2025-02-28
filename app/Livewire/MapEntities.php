<?php

namespace App\Livewire;

use Debugbar;
use App\Models\User;
use Livewire\Component;
use App\Models\MacroCategory;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Session;
use Livewire\Attributes\Computed;

#[Lazy]
class MapEntities extends Component
{
    public User $user;
    public $macroCategoriesWithDishes = [];

    public function mount(){
        // Carica tutte le macro categorie con le categorie, sottocategorie e piatti
        $macroCategories = $this->user->company->macroCategories()
            ->with([
                'categories.subCategories.dishes', // Piatti nelle sottocategorie
                'categories.dishes' // Piatti direttamente nella categoria (senza sottocategoria)
            ])
            ->get();


        // Crea una struttura di dati da utilizzare nella vista
        foreach ($macroCategories as $macroCategory) {
            $categoriesData = [];

            foreach ($macroCategory->categories as $category) {
                $subCategoriesData = [];

                // Raggruppa i piatti per sottocategoria
                foreach ($category->subCategories as $subCategory) {
                    $subCategoriesData[] = [
                        'name' => $subCategory->name,
                        'description' => $subCategory->description,
                        'dishes' => $subCategory->dishes->toArray() // Piatti associati alla sottocategoria
                    ];
                }

                // Piatti senza sottocategoria
                $dishesWithoutSubCategory = $category->dishes->toArray();

                // elimina i piatti già presenti nelle sottocategorie
                foreach ($subCategoriesData as $subCategory) {
                    $dishesWithoutSubCategory = array_filter($dishesWithoutSubCategory, function ($dish) use ($subCategory) {
                        return !in_array($dish, $subCategory['dishes']);
                    });
                }

                // Aggiungi i dati della categoria
                $categoriesData[] = [
                    'name' => $category->name,
                    'description' => $category->description,
                    'dishes_without_subcategory' => $dishesWithoutSubCategory,
                    'sub_categories' => $subCategoriesData,
                    'macro_category_id' => $macroCategory->id,
                    'id' => $category->id
                ];
            }

            // Aggiungi i dati della macro categoria
            $this->macroCategoriesWithDishes[] = [
                'name' => $macroCategory->name,
                'description' => $macroCategory->description,
                'categories' => $categoriesData
            ];

        }

        $this->dispatch('carica-tooltip');

        Debugbar::info($this->macroCategoriesWithDishes);

    }

    public function render()
    {
        return view('livewire.map-entities', [
            'macroCategoriesWithDishes' => $this->macroCategoriesWithDishes,
        ]);
    }
}
