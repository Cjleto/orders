<?php

namespace App\Livewire;

use Debugbar;
use App\Models\Dish;
use App\Rules\DishName;
use Livewire\Component;
use App\Enums\IsVisible;
use App\Models\Category;
use App\Http\Dtos\DishDto;
use App\Models\SubCategory;
use App\Helpers\LivewireSwal;
use App\Models\MacroCategory;
use Livewire\WithFileUploads;
use App\Http\Actions\CreateDishAction;
use App\Http\Actions\UpdateDishAction;
use App\Rules\DishDescription;
use App\Rules\LivewireFileNameTooLong;

class DishForm extends Component
{

    use WithFileUploads;

    public int $macroCategory_id;
    public int $category_id;
    public ?int $subCategory_id = NULL;
    public $newPhoto;

    public ?Dish $dish = NULL;
    public MacroCategory $macroCategory;
    public Category $category;
    public ?SubCategory $subCategory = NULL;

    public $name;
    public $description;
    public $price;
    public $photo;

    public $showLoader;

    public $listeners = ['updateDishForm'];

    public function mount()
    {

        $this->macroCategory = MacroCategory::findOrFail($this->macroCategory_id);
        $this->category = Category::findOrFail($this->category_id);
        $this->subCategory = SubCategory::find($this->subCategory_id);

        $this->showLoader = false;
    }

    public function updatedNewPhoto()
    {

        $this->validate([
            'newPhoto' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048',
                new LivewireFileNameTooLong()
            ]
        ]);

    }

    public function boot()
    {
        if ($this->dish) {
            $this->dish = Dish::findOrFail($this->dish->id);
            $this->name = $this->dish->name;
            $this->description = $this->dish->description;
            $this->price = $this->dish->price;

            $this->photo = $this->dish->getFirstMediaUrl('photo');
        }
    }

    public function updateDishForm($macroCategory_id, $category_id, $subCategory_id)
    {
        $this->macroCategory_id = $macroCategory_id;
        $this->category_id = $category_id;
        $this->subCategory_id = $subCategory_id;

        $this->macroCategory = MacroCategory::findOrFail($this->macroCategory_id);
        $this->category = Category::findOrFail($this->category_id);
        $this->subCategory = SubCategory::find($this->subCategory_id);
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'min:2',
                'max:55',
                new DishName($this->category, $this->dish),
            ],
            'description' => new DishDescription(),
            'price' => 'required|numeric',
            'newPhoto' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048',
                new LivewireFileNameTooLong()
            ]
        ];
    }

    public function storeDish()
    {

        $action = $this->dish ? new UpdateDishAction() : new CreateDishAction();

        /* Debugbar::info("save");
        Debugbar::info("macroCategory_id: " . $this->macroCategory_id);
        Debugbar::info("category_id: " . $this->category_id);
        Debugbar::info("subCategory_id: " . $this->subCategory_id);

        Debugbar::info("macroCategory: " . $this->macroCategory);
        Debugbar::info("category: " . $this->category);
        Debugbar::info("subCategory: " . $this->subCategory);

        Debugbar::info("end save"); */
        $validated = $this->validate();

        Debugbar::info($validated);

        $dishDto = new DishDto();
        $dishDto->id = $this->dish?->id;
        $dishDto->name = $this->name;
        $dishDto->description = (string)$this->description;
        $dishDto->price = $this->price;
        $dishDto->category_id = $this->category_id;
        $dishDto->sub_category_id = $this->subCategory_id > 0 ? $this->subCategory_id : NULL;
        $dishDto->is_visible = IsVisible::VISIBLE;
        $dishDto->photo = $this->newPhoto ?? $this->photo;

        try {
            $dish = $action->handle($dishDto);
        } catch (\Exception $e) {
            LivewireSwal::make($this)
                ->error()
                ->setParams([
                    'title' => 'Error',
                    'text' => 'An error occurred while creating the dish',
                    'footer' => $e->getMessage()
                ])
                ->fireSwalEvent();
            return;
        }


        if ($action instanceof UpdateDishAction) {
            $this->dispatch('refreshDishesList');
        }

        // Clear the form
        $this->reset([
            'name',
            'description',
            'price',
            'showLoader',
            'newPhoto'
        ]);

        $this->dispatch('progressUpdated', 100);

        LivewireSwal::make($this)
            ->success()
            ->setParams([
                'title' => trans('Success') . "!",
                'text' => trans('Dish') . ' created successfully',
                'footer' => trans('Create_another_dish')
            ])
            ->fireSwalEvent();
    }

    public function render()
    {
        return view('livewire.dish-form');
    }
}
