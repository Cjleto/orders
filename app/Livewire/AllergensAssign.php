<?php

namespace App\Livewire;

use Debugbar;
use App\Models\Dish;
use Livewire\Component;
use App\Models\Allergen;
use App\Models\Peculiarity;
use Livewire\Attributes\Computed;

class AllergensAssign extends Component
{

    public Dish $dish;
    public $availableAllergens;
    public $availablePeculiarities;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount()
    {
        $this->getAvailableAllergens();
        $this->getAvailablePeculiarities();
        $this->dish->load(['allergens', 'peculiarities']);

        $this->dispatch('carica-tooltip');
    }


    public function getAvailableAllergens()
    {

        $this->availableAllergens = Allergen::all();

        /* $this->dispatch('refreshComponent')->self(); */
    }


    public function getAvailablePeculiarities()
    {
        $this->availablePeculiarities = Peculiarity::all();

        /* $this->dispatch('refreshComponent')->self(); */
    }

    public function toggleAllergen($allergenId)
    {

        $allergen = Allergen::find($allergenId);

        Debugbar::info('dish: ' . $this->dish);

        if ($this->dish->allergens->contains($allergen)) {
            $this->dish->allergens()->detach($allergen);
        } else {
            $this->dish->allergens()->attach($allergen);
        }

        Debugbar::info('dish: ' . $this->dish);

        $this->dispatch('refreshComponent')->self();

    }

    public function togglePeculiarity($peculiarityId)
    {

        Debugbar::info('peculiarityId: ' . $peculiarityId);
        $peculiarity = Peculiarity::find($peculiarityId);

        if ($this->dish->peculiarities->contains($peculiarity)) {
            $this->dish->peculiarities()->detach($peculiarity);
        } else {
            $this->dish->peculiarities()->attach($peculiarity);
        }

        $this->dispatch('refreshComponent')->self();

    }

    /* public function updated ()
    {
        Debugbar::info('hydrate');
        $this->getAvailableAllergens();
    } */

    public function render()
    {
        return view('livewire.allergens-assign');
    }
}
