<?php

namespace App\Livewire;

use Livewire\Component;
use App\Enums\IsVisible;
use App\Models\SubCategory;
use App\Rules\CategoryName;
use App\Helpers\LivewireSwal;
use Illuminate\Validation\Rule;
use App\Http\Dtos\SubCategoryDto;
use App\Http\Actions\UpdateSubCategoryAction;

class SubCategoryEdit extends Component
{

    public SubCategory $sub_category;
    public $name;
    public $description;
    public $is_visible;

    protected $listeners = [
        'redirectConfirmed'
    ];

    public function mount()
    {
        $this->name = $this->sub_category->name;
        $this->description = $this->sub_category->description;
        $this->is_visible = $this->sub_category->is_visible;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                new CategoryName($this->sub_category),
            ],
            'description' => 'required|string|max:255',
            'is_visible' => [
                'required',
                Rule::enum(IsVisible::class),
            ],
        ];
    }

    public function save(UpdateSubCategoryAction $updateSubCategoryAction)
    {
        $validated = $this->validate($this->rules());

        $subCategoryDto = SubCategoryDto::fromArray($validated);

        $updateSubCategoryAction->handle($this->sub_category, $subCategoryDto);

        LivewireSwal::make($this)
            ->success()
            ->setParams([
                'title' => 'Success!',
                'text' => 'Category modified.',
                'emit' => 'redirectConfirmed',
            ])
            ->fireSwalEvent();

        $this->reset([
            'name',
            'description',
            'is_visible',
        ]);
    }

    public function redirectConfirmed()
    {
        return redirect()->route('categories.show', ['category' => $this->sub_category->category->id]);
    }


    public function render()
    {
        return view('livewire.sub-category-edit');
    }
}
