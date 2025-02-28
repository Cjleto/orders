<?php

namespace App\Livewire;

use App\Models\Dish;
use Livewire\Component;

class DishDelete extends Component
{
    public Dish $dish;

    public function deleteDish ()
    {
        $this->dish->delete();

        $this->dish->clearMediaCollection('images');

        $this->dispatch('refreshDishesList');
        $this->dispatch('close-modal');
    }

    public function render()
    {
        return view('livewire.dish-delete');
    }
}
