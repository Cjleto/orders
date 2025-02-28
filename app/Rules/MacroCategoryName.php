<?php

namespace App\Rules;

use Closure;
use App\Models\Company;
use App\Models\MacroCategory;
use Illuminate\Contracts\Validation\ValidationRule;

class MacroCategoryName implements ValidationRule
{

    public function __construct(private Company $company, private ?MacroCategory $macro_category = null){}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // verifico se il nome è unico per la company selezionata
        $exists = MacroCategory::where('name', $value)
            ->where('company_id', $this->company->id)
            ->when($this->macro_category, fn($query) => $query->where('id', '!=', $this->macro_category->id))
            ->exists();

        if ($exists) {
            $fail("Il nome della categoria macro deve essere unico per la company selezionata ({$this->company->name})");
        }

    }
}
