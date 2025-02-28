<?php

namespace App\Livewire;

use Livewire\Component;
use App\Enums\IsVisible;
use App\Models\Category;
use App\Rules\CategoryName;
use App\Helpers\LivewireSwal;
use App\Http\Dtos\CategoryDto;
use Illuminate\Validation\Rule;
use App\Http\Actions\UpdateCategoryAction;

class CategoryEdit extends Component
{

    public Category $category;
    public $name;
    public $description;
    public $is_visible;
    public $hide_price;

    protected $listeners = [
        'redirectConfirmed'
    ];

    public function mount()
    {
        $this->name = $this->category->name;
        $this->description = $this->category->description;
        $this->is_visible = $this->category->is_visible;
        $this->hide_price = $this->category->hide_price;

    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                new CategoryName($this->category),
            ],
            'description' => 'required|string|max:255',
            'is_visible' => [
                'required',
                Rule::enum(IsVisible::class),
            ],
            'hide_price' => 'required|boolean',
        ];
    }

    public function save(UpdateCategoryAction $updateCategoryAction)
    {
        $validated = $this->validate($this->rules());

        $categoryDto = CategoryDto::fromArray($validated);

        $updateCategoryAction->handle($this->category, $categoryDto);

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
        return redirect()->route('categories.show', ['category' => $this->category->id]);
    }

    public function render()
    {
        return view('livewire.category-edit');
    }
}
