<?php

namespace App\Livewire;

use Debugbar;
use Livewire\Component;
use App\Models\Category;
use App\Helpers\LivewireSwal;
use App\Models\MacroCategory;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Computed;
use Illuminate\Support\Collection;

#[Lazy]
class MacroCategoryShow extends Component
{
    public MacroCategory $macro_category;
    public $paginationCount = 15;

    public $listeners = [
        'refreshCategories' => '$refresh',
    ];

    public function updatedPaginationCount(int $value): void
    {
        $this->resetPage();
        $this->categories();
    }

    #[Computed(persist: true)]
    public function categories()
    {
        $query = $this->macro_category->categories()
            ->withCount(['dishes','subCategories'])
            ->orderBy('order', 'asc');
        $this->macro_category->load(['categories', 'categories.subCategories']);

        return $query->paginate($this->paginationCount);

    }

    public function updateCategoryOrder ($categories)
    {
        foreach ($categories as $category) {
            Category::whereId($category['value'])
                ->update(['order' => $category['order']]);
        }

        $this->categories();

        LivewireSwal::make($this)
            ->toast()
            ->success()
            ->setParams([
                'title' => trans('Success')."!",
                'text' => 'Category order updated successfully',
                ])
            ->fireSwalEvent();

    }

    public function render()
    {
        return view('livewire.macro-category-show',[
            'paginatedCategories' => $this->categories(), // Call the method instead of accessing the property
        ])->layout('components.layouts.app_livewire');
    }
}
