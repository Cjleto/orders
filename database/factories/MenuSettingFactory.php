<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\MenuSetting;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MenuSetting>
 */
class MenuSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'primary_color' => $this->faker->rgbColor,
            'secondary_color' => $this->faker->rgbColor,
            'tertiary_color' => $this->faker->rgbColor,
            'quaternary_color' => $this->faker->rgbColor,
            'title' => $this->faker->sentence(2),
            'background_opacity' => $this->faker->randomFloat(2, 0, 1),
            'template' => $this->faker->randomElement(['template1', 'template2',]),
            'selected_font' => 'Arial',
            'selected_font_secondary' => 'Arial',
            'text_footer' => $this->faker->sentence(3),
            'background_color' => $this->faker->hexColor,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (MenuSetting $menuSetting) {

            /* $sfondi_default = [
                'template1' => 'sfondo_future.jpg',
                'template2' => 'sfondo2.jpg',
                'template3' => 'sfondocaffe.jpg',
            ];

            // get random background
            $background = $sfondi_default[$menuSetting->template];

            $menuSetting->addMedia(public_path('img/initial_dishes/' . $background))
                ->preservingOriginal()
                ->setName('menu_wallpaper_' . Str::slug($menuSetting->name))
                ->toMediaCollection('menu_wallpaper'); */
        });
    }
}
