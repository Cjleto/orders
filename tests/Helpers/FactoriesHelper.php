<?php

use App\Models\Company;
use App\Models\MacroCategory;
use App\Models\Category;

if (!function_exists('createCompanyWithCategory')) {
    function createCompanyWithCategory()
    {
        $company = Company::factory()->create();
        $macro = MacroCategory::factory()->create(['company_id' => $company->id]);
        $category = Category::factory()->create(['macro_category_id' => $macro->id]);

        return compact('company', 'macro', 'category');
    }
}
