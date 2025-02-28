<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MacroCategory;

class MacroCategoryDelete extends Component
{

    public MacroCategory $macroCategory;

    public function deleteMacroCategory ()
    {

        $this->macroCategory->delete();
        $this->dispatch('refreshMacroCategories');
        $this->dispatch('close-modal');
    }

    public function render()
    {
        return view('livewire.macro-category-delete');
    }
}
