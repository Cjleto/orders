<?php

namespace App\Livewire;

use App\Models\Dish;
use Debugbar;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class DishItemMap extends Component
{

    public $dish_id;


    public function mount()
    {
    }

    #[Computed]
    public function dishItem(){
        $dish = Dish::findOrFail($this->dish_id);
        $dish->load('allergens', 'peculiarities','partialPrices');
        return $dish;
    }

    #[Computed]
    public function partialPricesTitle(){
        $partialPricesTitle = '';

        foreach ($this->dishItem->partialPrices as $partialPrice) {

            $partialPricesTitle .= $partialPrice->label . ' ' . $partialPrice->price . '€' . '<br>';
        }
        return $partialPricesTitle;
    }

    public function render()
    {
        $this->dispatch('carica-tooltip');
        return view('livewire.dish-item-map');
    }
}
