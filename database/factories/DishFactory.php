<?php

namespace Database\Factories;

use App\Models\Dish;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dish>
 */
class DishFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 1, 100),
            'category_id' => Category::factory(),
            'sub_category_id' => SubCategory::factory(),
            'is_visible' => $this->faker->boolean,
            'order' => null,
        ];
    }

    public function visible()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_visible' => true,
            ];
        });
    }

    public function configure()
    {
        return $this->afterCreating(function (Dish $dish) {
            // Aggiungere un logo tramite Media Library
            /* $dish->addMediaFromUrl('https://picsum.photos/100') */
            /* $dish->addMedia(public_path('img/nologo.jpeg'))
                ->preservingOriginal()
                ->setName('photo_'.Str::slug($dish->name))
                ->toMediaCollection('photo'); */

            // verifica se nel public path esiste il file con nome dish->name . '.jpg'
            // se esiste aggiungilo alla media collection

            if (file_exists(public_path('img/initial_dishes/' . Str::slug($dish->name) . '.jpg'))) {
                $dish->addMedia(public_path('img/initial_dishes/' . Str::slug($dish->name) . '.jpg'))
                    ->preservingOriginal()
                    ->setName('photo_' . Str::slug($dish->name))
                    ->toMediaCollection('photo');
            }



        });
    }
}
