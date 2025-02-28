<?php

namespace App\Rules;

use Closure;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Contracts\Validation\ValidationRule;

class SubCategoryName implements ValidationRule
{

    public function __construct(private Category $category, private ?SubCategory $subCategory = NULL){}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // verifico se il nome è unico per la category selezionata
        $exists = SubCategory::where('name', $value)
        ->where('category_id', $this->category->id)
        ->when($this->subCategory, function($query) {
            $query->where('id', '!=', $this->subCategory->id);
        })
        ->exists();

        if ($exists) {
            $fail("Il nome della sub categoria deve essere unico per la categoria selezionata ({$this->category->name})");
        }

    }
}
