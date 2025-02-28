<?php

namespace App\Livewire;

use Livewire\Component;
use App\Enums\IsVisible;
use App\Http\Actions\CreateSubCategoryAction;
use App\Http\Dtos\SubCategoryDto;
use App\Models\Category;
use App\Rules\SubCategoryName;
use Illuminate\Validation\Rule;

class SubCategoryCreate extends Component
{

    public Category $category;
    public $name;
    public $description;
    public $is_visible = IsVisible::VISIBLE;
    public $btnClass = 'btn btn-primary btn-sm';


    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                new SubCategoryName($this->category),
            ],
            'description' => 'required|string|max:255',
            'is_visible' => [
                'required',
                Rule::enum(IsVisible::class),
            ],
        ];
    }

    public function store(CreateSubCategoryAction $action)
    {

        $validated = $this->validate();

        $subCategoryDto = SubCategoryDto::fromArray($validated);

        $createdSubCategory = $action->handle($this->category, $subCategoryDto);

        $this->reset([
            'name',
            'description',
            'is_visible',
        ]);

        session()->flash('success', trans('Sub Category') . " {$createdSubCategory->name} created successfully!");

        $this->dispatch('refreshSubCategories');
    }


    public function render()
    {
        return view('livewire.sub-category-create');
    }
}
