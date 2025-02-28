<?php

namespace App\Http\Services;

class DishService {

    public function getDishes($category)
    {
        $dishes = $category->dishes->load('subCategory')->groupBy(function ($dish) {
            return $dish->subCategory ? $dish->subCategory->name : 'No SubCategory';
        });

        return $dishes;
    }


}
