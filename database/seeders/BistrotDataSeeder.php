<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\User;
use App\Models\Company;
use App\Models\Allergen;
use App\Models\Category;
use App\Enums\CompanyType;
use App\Models\MenuSetting;
use App\Models\Peculiarity;
use App\Models\SubCategory;

use App\Enums\CompanyStatus;
use App\Enums\FontFamilyEnum;
use App\Models\PartialPrice;
use App\Models\MacroCategory;
use Illuminate\Database\Seeder;
use function Laravel\Prompts\warning;

class BistrotDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $manager = User::factory()->manager()->create([
            'name' => 'bistrot',
            'email' => 'bistrot@admin.com',
            'password' => bcrypt('Qwerty7-')
        ]);

        $company = Company::factory()->recycle($manager)->create([
            'name' => 'Il Bistrot',
            'description' => 'le antiche mura',
            'address' => 'Via Mattei 1, 90149, Palermo',
            'slug' => 'le-antiche-mura',
            'status' => CompanyStatus::ACTIVE,
            'expiration_date' => '2025-12-31',
            'user_id' => $manager->id,
            'type' => CompanyType::RISTORANTE,
            'google_review_link'  =>  "https://search.google.com/local/writereview?placeid=ChIJa2OM1E_oGRMRMtouh6BPjI8",
            'facebook_link'  => "https://www.facebook.com/ristoranteleantichemura/?locale=it_IT",
            'instagram_link'  => "https://www.instagram.com/leantichemuramondello/?hl=it",
            'site_link'  => null
        ]);

        // aggiungi il logo alla company leggendo il file dalla cartella public img/nologo.jpeg
        $company->addMedia(public_path('img/logo-leantichemura.png'))
            ->preservingOriginal()
            ->toMediaCollection('logo');


        $this->createMenuSettings($company);

        $this->createCategories($company);
    }

    public function createMenuSettings(Company $company)
    {
        MenuSetting::factory()->create([
            'company_id' => $company->id,
            'primary_color' => '#411211',
            'secondary_color' => '#B97003',
            'tertiary_color' => '#B97003',
            'quaternary_color' => '#000000',
            'background_opacity' => 0.2,
            'title' => 'Il Bistrot',
            'template' => 'templatebistrot',
            'selected_font' => FontFamilyEnum::MONTSERRAT,
            'text_footer' => 'Coperto € 4,00',
            'background_color' => '#f0e9da',

        ]);
    }


    public function createCategories($company)
    {
        $initialData = [
            'macro_categories' => config('bistrotrestaurant.macro_categories_default'),
        ];


        foreach ($initialData['macro_categories'] as $macro) {

            $createdMacro = MacroCategory::factory()
                ->visible()
                ->recycle($company)
                ->create([
                    'name' => $macro['name'],
                    'description' => $macro['description'],
                    'is_visible' => 1,
                ]);


            foreach ($macro['categories'] as $categoryArray) {
                foreach ($categoryArray as $categoryData) {
                    $createdCategory = Category::factory()
                        ->visible()
                        ->recycle($createdMacro)
                        ->create([
                            'name' => $categoryData['name'],
                            'description' => $categoryData['description'],
                            'is_visible' => 1,
                        ]);

                    if (isset($categoryData['dishes'])) {
                        foreach ($categoryData['dishes'] as $dishData) {
                            $createdDish = Dish::factory()
                                ->visible()
                                ->recycle($createdCategory)
                                ->create($dishData + ['sub_category_id' => null]);
                        }
                    }

                    if (isset($categoryData['sub_categories'])) {

                        foreach ($categoryData['sub_categories'] as $subData) {

                            $createdSub = SubCategory::factory()
                                ->visible()
                                ->recycle($createdCategory)
                                ->create([
                                    'name' => $subData['name'],
                                    'description' => '',
                                    'is_visible' => 1,
                                ]);

                            if (isset($subData['dishes'])) {
                                foreach ($subData['dishes'] as $dishData) {

                                    $partialsPrices = [];
                                    if(isset($dishData['partial_prices'])) {
                                        $partialsPrices = $dishData['partial_prices'];
                                        unset($dishData['partial_prices']);
                                    }

                                    $createdDish = Dish::factory()
                                        ->visible()
                                        ->recycle($createdCategory)
                                        ->recycle($createdSub)
                                        ->create($dishData);

                                    if (isset($partialsPrices)) {
                                        foreach ($partialsPrices as $partialPrice) {
                                            PartialPrice::factory()
                                                ->create([
                                                    'dish_id' => $createdDish->id,
                                                    'label' => $partialPrice['label'],
                                                    'price' => $partialPrice['price']
                                                ]);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
