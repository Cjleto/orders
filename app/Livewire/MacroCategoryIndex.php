<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Helpers\LivewireSwal;
use App\Models\MacroCategory;
use Livewire\Attributes\Lazy;
use Illuminate\Support\Facades\Auth;

#[Lazy()]
class MacroCategoryIndex extends Component
{

    public $macro_categories;

    public function mount()
    {
        $this->getMacroCategories();
    }

    #[On('refreshMacroCategories')]
    public function getMacroCategories()
    {
        $company = Auth::user()->company;
        $this->macro_categories = $company->macroCategories()
            ->with(['categories.dishes'])
            ->withCount(['categories','dishes'])
            ->orderBy('order')->get();

    }

    public function updateMacroCategoryOrder($macro_categories){
        foreach ($macro_categories as $macro_category) {
            MacroCategory::whereId($macro_category['value'])
                ->update(['order' => $macro_category['order']]);
        }

        $this->getMacroCategories();

        LivewireSwal::make($this)
            ->toast()
            ->success()
            ->setParams([
                'title' => trans('Success') . "!",
                'text' => 'Macro Category order updated successfully',
            ])
            ->fireSwalEvent();
    }

    public function render()
    {
        return view('livewire.macro-category-index');
    }
}
