<?php

namespace App\Livewire;

use Livewire\Component;
use App\Enums\IsVisible;
use App\Rules\CategoryName;
use App\Models\MacroCategory;
use App\Http\Dtos\CategoryDto;
use Illuminate\Validation\Rule;
use App\Http\Services\CategoryService;
use App\Http\Actions\CreateCategoryAction;

class CategoryCreate extends Component
{

    public MacroCategory $macro_category;
    public $name;
    public $description;
    public $is_visible = IsVisible::VISIBLE;
    public $hide_price = false;
    public $btnClass = 'btn btn-primary btn-sm';

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                new CategoryName($this->macro_category),
            ],
            'description' => 'required|string|max:255',
            'is_visible' => [
                'required',
                Rule::enum(IsVisible::class),
            ],
            'hide_price' => 'required|boolean',
        ];
    }

    public function store(CreateCategoryAction $createCategoryAction)
    {

        $validated = $this->validate();

        $categoryDto = CategoryDto::fromArray($validated);

        $createdCategory = $createCategoryAction->handle($this->macro_category, $categoryDto);

        $this->reset([
            'name',
            'description',
            'is_visible',
            'hide_price',
        ]);

        session()->flash('success', "Category {$createdCategory->name} created successfully!");

        $this->dispatch('refreshCategories');

    }



    public function render()
    {
        return view('livewire.category-create');
    }
}
