<?php

namespace App\Livewire;

use App\Models\Dish;
use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Attributes\On;
use App\Helpers\LivewireSwal;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Computed;

#[Lazy]
class CategoryShow extends Component
{

    protected $listeners = ['refreshSubCategories' => '$refresh'];

    public Category $category;
    public $paginationCount = 15;

    public function updatedPaginationCount(int $value): void
    {
        $this->resetPage();
        $this->subCategories();
    }

    #[Computed(persist: true)]
    public function subCategories()
    {
        $query = $this->category->subCategories()->withCount('dishes');

        return $query->paginate($this->paginationCount);
    }

    public function updateSubCategoryOrder($sub_categories)
    {

        foreach ($sub_categories as $sub_category) {
            SubCategory::whereId($sub_category['value'])
                ->update(['order' => $sub_category['order']]);
        }

        $this->subCategories();

        LivewireSwal::make($this)
            ->toast()
            ->success()
            ->setParams([
                'title' => trans('Success') . "!",
                'text' => 'Sub Category order updated successfully',
            ])
            ->fireSwalEvent();
    }


    public function render()
    {
        return view('livewire.category-show', [
            'paginatedSubCategories' => $this->subCategories(), // Call the method instead of accessing the property
        ])->layout('components.layouts.app_livewire');
    }
}
