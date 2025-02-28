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
use Illuminate\Support\Arr;
use App\Helpers\LivewireSwal;
use App\Models\MacroCategory;
use Livewire\WithFileUploads;
use App\Http\Actions\CreateDishAction;
use App\Http\Actions\UpdateDishAction;
use App\Rules\DishDescription;

class DishEdit extends Component
{

    use WithFileUploads;

    public Dish $dish;
    public $newPhoto;

    public $name;
    public $description;
    public $price;
    public $photo;

    public $selected_macro_id;
    public $selected_category_id;
    public $selected_sub_category_id;

    public $availableMacroCategories = [];
    public $availableCategories = [];
    public $availableSubCategories = [];

    public $showLoader;

    public function mount()
    {
        $this->name = $this->dish->name;
        $this->description = (string)$this->dish->description;
        $this->price = $this->dish->price;

        $this->photo = $this->dish->getFirstMediaUrl('photo');

        $this->showLoader = false;

        $this->dish->load('category', 'category.macroCategory', 'subCategory');
        $this->availableMacroCategories = $this->dish->category->company->macroCategories;

        $this->selected_macro_id = $this->dish->category->macro_category_id;
        $this->selected_category_id = $this->dish->category_id;
        $this->selected_sub_category_id = $this->dish->sub_category_id;

        if (!is_null($this->selected_macro_id)) {
            $this->availableCategories = Category::where('macro_category_id', $this->selected_macro_id)->get();
        }

        if (!is_null($this->selected_category_id)) {
            $this->availableSubCategories = SubCategory::where('category_id', $this->selected_category_id)->get();
            if (count($this->availableSubCategories) == 0) {
                $this->selected_sub_category_id = 0;
            }
        }

    }


    public function rules()
    {

        return [
            'description' => [new DishDescription()],
        ];

        return [
            'name' => [
                'required',
                'min:2',
                'max:55',
                new DishName($this->dish->category, $this->dish),
            ],
            'description' => new DishDescription(),
            'price' => 'required|numeric',
            'newPhoto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'selected_macro_id' => 'required|exists:macro_categories,id',
            'selected_category_id' => [
                'required',
                'exists:categories,id',
                function ($attribute, $value, $fail) {
                    // Verifica se la categoria ha il macro_category_id corretto
                    $category = Category::find($value);
                    if ($category && $category->macro_category_id != $this->selected_macro_id) {
                        $fail('La categoria selezionata deve appartenere alla macro categoria selezionata.');
                    }
                },
            ],
            'selected_sub_category_id' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value != 0 && !SubCategory::query()->where('id', $value)->exists()) {
                        $fail('The selected sub category is invalid.');
                    }
                }
            ],
        ];
    }

    public function updatedSelectedMacroId($macro_id)
    {
        $this->selected_category_id = NULL;
        $this->selected_sub_category_id = NULL;
        $this->availableCategories = Category::where('macro_category_id', $macro_id)->get();
    }

    public function updatedSelectedCategoryId($category_id)
    {
        $this->selected_sub_category_id = NULL;
        $this->availableSubCategories = SubCategory::where('category_id', $category_id)->get();

        if (empty($this->availableSubCategories)) {
            $this->selected_sub_category_id = 0;
        }

    }

    public function updateDish(UpdateDishAction $action)
    {

        Debugbar::info('updateDish');
        Debugbar::info($this->selected_sub_category_id);

        try {

            $validated = $this->validate();

            $dishDto = new DishDto();
            $dishDto->id = $this->dish?->id;
            $dishDto->name = $this->name;
            $dishDto->description = (string)$this->description;
            $dishDto->price = $this->price;
            $dishDto->category_id = $this->selected_category_id;
            $dishDto->sub_category_id = (int) $this->selected_sub_category_id > 0 ? (int) $this->selected_sub_category_id : NULL;
            $dishDto->is_visible = IsVisible::VISIBLE;
            $dishDto->photo = $this->newPhoto ?? $this->photo;

            $dish = $action->handle($dishDto);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errorMessages = implode(', ', Arr::flatten($e->errors()));
            // Intercetta l'eccezione di validazione e mostra un messaggio con SweetAlert
            LivewireSwal::make($this)
                ->error()
                ->setParams([
                    'title' => 'Validation Error',
                    'text' => $errorMessages,
                    'footer' => trans('validation.validation_invitation'),
                ])
                ->fireSwalEvent();
            return;
        } catch (\Exception $e) {
            LivewireSwal::make($this)
                ->error()
                ->setParams([
                    'title' => 'Error',
                    'text' => trans('validation.dish_update_error'),
                    'footer' => $e->getMessage()
                ])
                ->fireSwalEvent();
            return;
        }

        //$this->dispatch('refreshDishesList');

        // Clear the form
        $this->reset([
            'showLoader',
        ]);

        LivewireSwal::make($this)
            ->success()
            ->setParams([
                'title' => trans('Success') . "!",
                'text' => trans('Dish') . ' updated successfully',
                'emit' => 'refreshDishesList'
            ])
            ->fireSwalEvent();

            //$this->dispatch('close-modal');
    }

    public function render()
    {
        return view('livewire.dish-edit');
    }
}
