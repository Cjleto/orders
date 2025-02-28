<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryDelete extends Component
{

    public Category $category;

    public function deleteCategory ()
    {
        $this->category->delete();
        $this->dispatch('refreshCategoriesList');
        $this->dispatch('close-modal');
    }

    public function render()
    {
        return view('livewire.category-delete');
    }
}
