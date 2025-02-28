<?php

namespace App\Http\Actions;

use App\Models\Category;
use App\Models\MacroCategory;
use App\Http\Dtos\CategoryDto;
use App\Http\Services\CompanyService;
use App\Events\TranslatableUpdatedEvent;

class CreateCategoryAction
{
    public function handle(MacroCategory $macro_category, CategoryDto $categoryDto): Category
    {
        $category = $macro_category->categories()->create([
            'name' => $categoryDto->name,
            'description' => $categoryDto->description,
            'order' => $categoryDto->order ?? null,
            'is_visible' => $categoryDto->is_visible,
            'hide_price' => $categoryDto->hide_price,
        ]);

        (new CompanyService)->forgetMenuMap($category->company);

        return $category;
    }
}
