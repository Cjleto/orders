<?php

namespace App\Rules;

use Closure;
use App\Models\Dish;
use App\Models\Category;
use App\Models\MacroCategory;
use Illuminate\Contracts\Validation\ValidationRule;

class DishName implements ValidationRule
{

    public function __construct(private Category $category, private ?Dish $dish = NULL){}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        if(config('myconst.unique_dish_name') == false) {
            return;
        }

        // verifico se il nome è unico per la macro selezionata
        $exists = Dish::where('name', $value)
            ->where('category_id', $this->category->id)
            ->when($this->dish, function($query) {
                $query->where('id', '!=', $this->dish->id);
            })
            ->exists();

        if ($exists) {
            $fail("Il nome del ".trans('Dish')." deve essere unico per la ".trans('Category')." selezionata ({$this->category->name})");
        }

    }
}
