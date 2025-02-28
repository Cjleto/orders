<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\User;
use App\Models\Company;
use App\Models\Allergen;
use App\Models\Category;
use App\Models\Peculiarity;
use App\Models\SubCategory;
use App\Models\PartialPrice;

use App\Models\MacroCategory;
use App\Models\MenuSetting;
use Illuminate\Database\Seeder;
use function Laravel\Prompts\warning;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admin = User::factory()->admin()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('Qwerty7-')
        ]);

        $manager = User::factory()->manager()->create([
            'name' => 'manager',
            'email' => 'manager@manager.com',
            'password' => bcrypt('Qwerty7-')
        ]);

        $company = Company::factory()->recycle($manager)->create();

        $this->createMenuSettings($company);

        $this->createAllergens();
        $this->createPeculiarities();
        $this->createCategories($company);

        User::factory(5)->manager()->create()->each(
            function ($user){
                // Per ogni utente, crea un ristorante riciclando l'utente
                $company = Company::factory()->recycle($user)->create();

                $this->createMenuSettings($company);

                $this->createCategories($company);

            }
        );
    }

    public function createMenuSettings (Company $company)
    {

        MenuSetting::factory()->create([
            'company_id' => $company->id,
            'primary_color' => '#2196F3',
            'secondary_color' => '#673AB7',
            'tertiary_color' => '#FFC107',
            'quaternary_color' => '#FF5722',

        ]);
    }

    public function createAllergens()
    {
        $allergens = config('myconst.initial_allergens');

        foreach ($allergens as $allergen) {
            Allergen::factory()->create([
                'name' => $allergen['name'],
                'description' => 'Può contenere ' . $allergen['name'],
                'icon' => $allergen['icon']
            ]);
        }
    }

    public function createPeculiarities()
    {
        $peculiarities = config('myconst.initial_peculiarities');

        foreach ($peculiarities as $peculiarity) {
            Peculiarity::factory()->create([
                'name' => $peculiarity['name'],
                'description' => $peculiarity['name'],
                'icon' => $peculiarity['icon']
            ]);
        }
    }

    public function createCategories($company)
    {
        $initialData = [
            'macro_categories' => config('myconst.macro_categories_default'),
            'categories' => config('myconst.categories_default'),
            'sub_categories' => config('myconst.sub_categories_default'),
            'dishes' => config('myconst.dish_default'),
            'partial_prices' => config('myconst.partial_price_default'),
            'allergens' => config('myconst.initial_allergens')
        ];


        foreach ($initialData['macro_categories'] as $macro) {
            $createdMacro = MacroCategory::factory()
                ->visible()
                ->recycle($company)
                ->create($macro);

            foreach ($initialData['categories'][$createdMacro->name] as $categoryData) {
                $createdCategory = Category::factory()
                    ->visible()
                    ->recycle($createdMacro)
                    ->create($categoryData);

                if (!isset($initialData['sub_categories'][$createdCategory->name])) {
                    continue;
                }

                foreach ($initialData['sub_categories'][$createdCategory->name] as $subCategoryData) {
                    $createdSubCategory = SubCategory::factory()
                        ->visible()
                        ->recycle($createdCategory)
                        ->create($subCategoryData);

                    if (!isset($initialData['dishes'][$createdCategory->name])) {
                        continue;
                    }
                }

                foreach ($initialData['dishes'][$createdCategory->name] as $dishData) {
                    $createdDish = Dish::factory()
                        ->visible()
                        ->recycle($createdSubCategory)
                        ->recycle($createdCategory)
                        ->create($dishData);

                    if (!isset($initialData['partial_prices'][$createdDish->name])) {
                        continue;
                    }

                    // prendi 3 allergeni random e assegnali al piatto
                    $allergens = Allergen::inRandomOrder()->limit(3)->get();
                    $createdDish->allergens()->attach($allergens);

                    // prendi 2 peculiarità random e assegnale al piatto
                    $peculiarities = Peculiarity::inRandomOrder()->limit(2)->get();
                    $createdDish->peculiarities()->attach($peculiarities);

                    foreach ($initialData['partial_prices'][$createdDish->name] as $partialPriceData) {
                        PartialPrice::factory()
                            ->recycle($createdDish)
                            ->create($partialPriceData);
                    }
                }
            }
        }
    }
}
