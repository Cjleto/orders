<?php

namespace App\Livewire;

use App\Models\Dish;
use Debugbar;
use Livewire\Component;
use App\Helpers\LivewireSwal;

class PartialPriceAssign extends Component
{

    public Dish $dish;

    public $partial_prices = [];

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount()
    {

        $this->dish->load('partialPrices');


        // Se ci sono prezzi parziali, li carica nell'array
        if ($this->dish->partialPrices->count() > 0) {
            $this->partial_prices = $this->dish->partialPrices()->select('label', 'price')->get()->toArray();
        }


        while(count($this->partial_prices) < 2) {
            $this->partial_prices[] = ['label' => '', 'price' => ''];
        }



        $this->dispatch('refreshComponent')->self();

    }

    public function rules()
    {
        return [
            'partial_prices.*.label' => 'required_with:partial_prices.*.price|string|max:255',
            'partial_prices.*.price' => 'required_with:partial_prices.*.label|numeric|min:0',
        ];
    }


    public function removePartialPrice($index)
    {
        $this->partial_prices[$index] = ['label' => '', 'price' => ''];
    }

    public function save()
    {

        $validated = $this->validate($this->rules());

        $filteredData = array_filter($validated['partial_prices'], function ($item) {
            return $item['label'] != '' && $item['price'] != '';
        });

        // delete degli esistenti
        $this->dish->partialPrices()->delete();

        // Salva i prezzi parziali
        foreach ($filteredData as $partial_price) {

            $this->dish->partialPrices()->create($partial_price);
        }

        // Aggiorna la lista dei prezzi parziali
        $this->dish->load('partialPrices');

        LivewireSwal::make($this)
            ->toast()
            ->success()
            ->setParams([
                'title' => 'Successo!',
                'text' => 'Partial Price settato con successo.',
                'emit' => 'refreshComponent',
            ])
            ->fireSwalEvent();


    }

    public function render()
    {
        return view('livewire.partial-price-assign');
    }
}
