<?php

namespace App\Livewire;

use Debugbar;
use App\Models\Dish;
use App\Models\User;
use App\Models\Company;
use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Attributes\On;

class DishCreate extends Component
{

    private $containerClass = 'container-fluid';

    public User $user;

    public $selected_macro_id = NULL;
    public $selected_category_id = NULL;
    public $selected_sub_category_id = NULL;

    public $availableMacroCategories = [];
    public $availableCategories = [];
    public $availableSubCategories = [];

    public $progessPerc = 0;

    public $enableDishForm = false;

    protected $listeners = ['progressUpdated' => 'updateProgressPerc'];

    public function rules()
    {
        return [
            'selected_macro_id' => 'required|exists:macro_categories,id',
            'selected_category_id' => 'required|exists:categories,id',
            'selected_sub_category_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value != 0 && !SubCategory::query()->where('id', $value)->exists()) {
                        $fail('The selected sub category is invalid.');
                    }
                }
            ],
        ];
    }

    public function mount()
    {

        $this->getAvailableMacroCategories();

        if(!is_null($this->selected_macro_id)) {
            $this->getAvailableCategories();
        }

        if(!is_null($this->selected_category_id)) {
            $this->getAvailableSubCategories();

        }

        $this->setProgressPerc();
    }

    #[On('refreshMacroCategories')]
    public function getAvailableMacroCategories ()
    {
        $this->availableMacroCategories = $this->user->company->macroCategories;
    }


    #[On('refreshCategories')]
    public function getAvailableCategories ()
    {
        $this->availableCategories = Category::where('macro_category_id', $this->selected_macro_id)->get();
    }

    #[On('refreshSubCategories')]
    public function getAvailableSubCategories ()
    {
        $this->availableSubCategories = SubCategory::where('category_id', $this->selected_category_id)->get();
        if (count($this->availableSubCategories) == 0) {
            $this->selected_sub_category_id = 0;
        }
    }

    public function updatedSelectedMacroId($macro_id)
    {
        $this->selected_category_id = NULL;
        $this->selected_sub_category_id = NULL;
        $this->availableCategories = Category::where('macro_category_id', $macro_id)->get();

        $this->setProgressPerc();
    }

    public function updatedSelectedCategoryId($category_id)
    {
        $this->selected_sub_category_id = NULL;
        $this->availableSubCategories = SubCategory::where('category_id', $category_id)->get();

        if(empty($this->availableSubCategories)) {
            $this->selected_sub_category_id = 0;
        }

        $this->setProgressPerc();
    }




    public function updatedSelectedSubCategoryId($sub_category_id)
    {

        Debugbar::info("updatedSelectedSubCategoryId => " . $sub_category_id);
        if(!is_numeric($sub_category_id)){
            $this->setProgressPerc();
            return;
        }

        $this->dispatch('updateDishForm', $this->selected_macro_id, $this->selected_category_id, $this->selected_sub_category_id);
        $this->setProgressPerc();
    }

    public function setProgressPerc()
    {
        // verifica quanti fra $availableMacroCategories, $availableCategories e $availableSubCategories non sono vuoti
        $total = 8; // 3 corrispondono ai campi presenti in dish-form
        $filled = 1;

        $this->enableDishForm = false;

        if (!is_null($this->selected_macro_id)) {
            $this->validateOnly('selected_macro_id');
            $filled++;
        }

        if (!is_null($this->selected_category_id)) {
            $this->validateOnly('selected_category_id');
            $filled++;
        }

        if (!is_null($this->selected_sub_category_id)) {
            $this->validateOnly('selected_sub_category_id');
            $filled++;
        }

        $this->progessPerc = ($filled / $total) * 100;


        $this->enableDishForm = $filled == 4;

    }

    public function updateProgressPerc($perc)
    {
        $this->progessPerc = $perc;
    }

    public function render()
    {

        return view('livewire.dish-create')
            ->layout('components.layouts.app_livewire', ['containerClass' => $this->containerClass]);
    }
}
