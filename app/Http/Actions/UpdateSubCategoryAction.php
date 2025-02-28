<?php

namespace App\Http\Actions;

use App\Models\Category;
use App\Models\SubCategory;
use App\Http\Dtos\SubCategoryDto;
use App\Http\Services\CompanyService;
use App\Events\TranslatableUpdatedEvent;

class UpdateSubCategoryAction
{
    public function handle(SubCategory $subCategory, SubCategoryDto $subCategoryDto): SubCategory
    {

        $toTranslate = array_filter(
            $subCategory->getTranslatableFields(),
            function ($field) use ($subCategory, $subCategoryDto) {
                return $subCategory->$field != $subCategoryDto->$field;
            }
        );

        $subCategory->update([
            'name' => $subCategoryDto->name,
            'description' => $subCategoryDto->description,
            'is_visible' => $subCategoryDto->is_visible,
        ]);

        foreach ($toTranslate as $field) {
            event(new TranslatableUpdatedEvent($subCategory, $field));
        }

        (new CompanyService)->forgetMenuMap($subCategory->category->company);

        return $subCategory;
    }
}
