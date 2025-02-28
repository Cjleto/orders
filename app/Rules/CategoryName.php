<?php

namespace App\Rules;

use Closure;
use App\Models\Category;
use App\Models\BaseCategory;
use App\Models\MacroCategory;
use Illuminate\Contracts\Validation\ValidationRule;

class CategoryName implements ValidationRule
{

    public function __construct(private BaseCategory $model){}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        // verifico se il nome è unico per la macro selezionata
        $exists = Category::where('name', $value)
            ->when($this->model instanceof Category, function($query) {
                $query->where('id', '!=', $this->model->id)
                    ->where('macro_category_id', $this->model->macroCategory->id);;
            })
            ->when($this->model instanceof MacroCategory, function($query) {
                $query->where('macro_category_id', $this->model->id);
            })
            ->exists();

        $macro = $this->model instanceof Category ? $this->model->macroCategory : $this->model;

        if ($exists) {
            $fail("Il nome della categoria deve essere unico per la macro selezionata ({$macro->name})");
        }

    }
}
