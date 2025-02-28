<?php

namespace App\Livewire;

use App\Models\SubCategory;
use Livewire\Component;

class SubCategoryDelete extends Component
{

    public SubCategory $subCategory;

    public function deleteSubCategory ()
    {

        $this->subCategory->delete();
        $this->dispatch('refreshSubCategories');
        $this->dispatch('close-modal');
    }

    public function render()
    {
        return view('livewire.sub-category-delete');
    }
}
