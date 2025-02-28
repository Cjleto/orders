<?php

namespace App\Http\Actions;

use App\Models\Category;
use App\Models\MacroCategory;
use App\Http\Dtos\CategoryDto;
use App\Http\Services\CompanyService;
use App\Events\TranslatableUpdatedEvent;

class UpdateCategoryAction
{
    public function handle(Category $category, CategoryDto $categoryDto): Category
    {

        $toTranslate = array_filter($category->getTranslatableFields(), function ($field) use ($category, $categoryDto) {
            return $category->$field != $categoryDto->$field;
        });

        $category->update([
            'name' => $categoryDto->name,
            'description' => $categoryDto->description,
            'is_visible' => $categoryDto->is_visible,
            'hide_price' => $categoryDto->hide_price,
        ]);

        foreach ($toTranslate as $field) {
            event(new TranslatableUpdatedEvent($category, $field));
        }

        (new CompanyService)->forgetMenuMap($category->company);

        return $category;
    }
}
