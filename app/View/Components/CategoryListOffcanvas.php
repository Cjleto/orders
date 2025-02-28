<?php

namespace App\View\Components;

use App\Http\Services\DishService;
use Closure;
use App\Models\Category;
use App\Models\SubCategory;
use Debugbar;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class CategoryListOffcanvas extends Component
{
    public $dishes;

    public function __construct(
        private DishService $dishService,
        public Category $category,
        public ?SubCategory $subCategory = null,
    ){

        /* if($this->subCategory) {
            $this->dishes = $this->subCategory->dishes;
        } elseif ($this->category) {
            $this->dishes = $this->category->dishes;
        } */

        $this->dishes = $this->dishService->getDishes($this->category);


        //dd($this->dishes->pluck('name','id'));

    }

    public function render(): View|Closure|string
    {
        return view('components.category-list-offcanvas');
    }
}
