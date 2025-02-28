<?php

namespace App\View\Components;

use App\Models\Allergen;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuAllergensFooter extends Component
{
    public $allergens;

    public function __construct()
    {
        $this->allergens = Allergen::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu-allergens-footer');
    }
}
