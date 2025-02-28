<?php

namespace App\Http\Actions;

use App\Models\Category;
use App\Models\SubCategory;
use App\Http\Dtos\SubCategoryDto;
use App\Http\Services\CompanyService;
use App\Events\TranslatableUpdatedEvent;

class CreateSubCategoryAction
{
    public function handle(Category $category, SubCategoryDto $subCategoryDto): SubCategory
    {
        $subCategory = $category->subCategories()->create([
            'name' => $subCategoryDto->name,
            'description' => $subCategoryDto->description,
            'order' => $subCategoryDto->order ?? null,
            'is_visible' => $subCategoryDto->is_visible,
        ]);

        (new CompanyService)->forgetMenuMap($category->company);

        return $subCategory;
    }
}
