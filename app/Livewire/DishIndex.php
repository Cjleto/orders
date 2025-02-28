<?php

namespace App\Livewire;

use App\Models\Dish;
use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Livewire\WithPagination;
use App\Helpers\LivewireSwal;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use Barryvdh\Debugbar\Facades\Debugbar;
use Barryvdh\Debugbar\Twig\Extension\Debug;

#[Lazy]
class DishIndex extends Component
{
    use WithPagination;

    public ?Category $category = null;
    public ?SubCategory $sub_category = null;
    public string $search = '';

    public $paginationCount = 15;

    protected $listeners = ['refreshDishesList' => 'mount'];

    public function mount()
    {
        if (!empty($this->search)) {
            $this->updatedSearch($this->search);
        }
    }

    public function updatedSearch($value)
    {
        $this->resetPage(); // Important: Reset pagination when search changes
    }

    public function updatedPaginationCount (int $value): void
    {
        $this->resetPage();
        $this->dishes();

    }

    #[Computed()]
    public function dishes()
    {

        $query = Dish::query()->with('subCategory', 'category', 'photo');

        if ($this->sub_category) {
            $query->where('sub_category_id', $this->sub_category->id);
            $this->category = $this->sub_category->category;
        } elseif ($this->category) {
            $query->where('category_id', $this->category->id);
        }

        if ($this->search) {
            if (is_numeric($this->search) && Dish::find($this->search)) {
                $query->where('id', $this->search);
            } else {
                $query->where('name', 'like', '%' . $this->search . '%');
            }
        }

        $query->orderBy('order', 'asc');

        return $query->paginate($this->paginationCount);
    }

    public function updateDishOrder($dishes)
    {

        foreach ($dishes as $dish) {
            Dish::whereId($dish['value'])
                ->update(['order' => $dish['order']]);
        }

        // Refresh the computed property
        //$this->dishes();

        LivewireSwal::make($this)
            ->toast()
            ->success()
            ->setParams([
                'title' => trans('Success') . "!",
                'text' => trans('Dish order updated successfully'),
            ])
            ->fireSwalEvent();
    }

    public function render(): View
    {
        return view('livewire.dish-index', [
            'paginatedDishes' => $this->dishes(), // Call the method instead of accessing the property
        ])->layout('components.layouts.app_livewire');
    }
}
