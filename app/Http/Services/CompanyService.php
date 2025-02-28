<?php

namespace App\Http\Services;

use App\Models\Company;
use Debugbar;
use Illuminate\Support\Facades\Cache;


class CompanyService
{

    public function getMenuMapCacheKey(Company $company)
    {
        return 'company_' . $company->id . '_menumap';
    }

    public function forgetMenuMap(Company $company)
    {
        Cache::forget($this->getMenuMapCacheKey($company));
        Debugbar::info('Cache cancellata');
    }

    public function getMenumap(Company $company)
    {
        $cacheKey = $this->getMenuMapCacheKey($company);

        return Cache::remember($cacheKey, 1, function () use ($company) {
            // Carica tutte le macro categorie con le categorie, sottocategorie e piatti
            $macroCategoriesWithDishes = $company->macroCategories()
                ->visible()
                ->with([
                    'categories' => function ($query) {
                        $query->visible() // Applica lo scope 'visible' sulle categories
                            ->with([
                                'dishes' => function ($dishQuery) {
                                    $dishQuery->visible() // Applica lo scope 'visible' sui dishes delle categories
                                        ->with([
                                            'allergens',
                                            'peculiarities',
                                            'photo',
                                            'partialPrices',
                                            'category',
                                        ]);
                                },
                                'subCategories' => function ($subQuery) {
                                    $subQuery->visible() // Applica lo scope 'visible' sulle subCategories
                                        ->with([
                                            'dishes' => function ($subDishQuery) {
                                                $subDishQuery->visible() // Applica lo scope 'visible' sui dishes delle subCategories
                                                    ->with([
                                                        'allergens',
                                                        'peculiarities',
                                                        'photo',
                                                        'partialPrices',
                                                        'category',
                                                    ]);
                                            },
                                        ]);
                                },
                            ]);
                    },
                ])
                ->get()
                ->map(function ($macroCategory) {
                    return [
                        'macro_obj' => $macroCategory,
                        'name' => $macroCategory->name,
                        'description' => $macroCategory->description,
                        'categories' => $macroCategory->categories->map(function ($category) use ($macroCategory) {
                            // Raggruppa i piatti per sottocategoria
                            $subCategoriesData = $category->subCategories->map(function ($subCategory) use ($category) {
                                return [
                                    'sub_category_obj' => $subCategory,
                                    'name' => $subCategory->name,
                                    'description' => $subCategory->description,
                                    'dishes' => $subCategory->dishes->map(function ($dish) use ($category) {
                                        if ($category->hide_price == 1) {
                                            $dish->price = null;
                                            return $dish;
                                        }

                                        $dish->price = $dish->price . " €";

                                        return $dish;
                                    }), // Piatti associati alla sottocategoria
                                ];
                            });

                            // Piatti senza sottocategoria
                            $dishesWithoutSubCategory = $category->dishes->map(function ($dish) use ($category) {
                                if ($category->hide_price == 1) {
                                    $dish->price = null;
                                    return $dish;
                                }

                                $dish->price = $dish->price . " €";

                                return $dish;
                            });

                            // Elimina i piatti già presenti nelle sottocategorie
                            foreach ($subCategoriesData as $subCategory) {
                                $dishesWithoutSubCategory = $dishesWithoutSubCategory->filter(function ($dish) use ($subCategory) {
                                    return !$subCategory['dishes']->contains($dish);
                                });
                            }

                            return [
                                'category_obj' => $category,
                                'name' => $category->name,
                                'description' => $category->description,
                                'dishes_without_subcategory' => $dishesWithoutSubCategory, // Riordina l'array
                                'sub_categories' => $subCategoriesData,
                                'macro_category_id' => $macroCategory->id,
                                'id' => $category->id
                            ];
                        })
                    ];
                });

            return $macroCategoriesWithDishes;
        });
    }
}
