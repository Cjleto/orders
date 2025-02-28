<?php

namespace App\Livewire;

use App\Models\MenuSetting;
use Livewire\Component;

class MenuTextFooter extends Component
{
    public MenuSetting $menuSetting;
    public string $class = 'text-center text-danger';

    public function render()
    {
        return view('livewire.menu-text-footer');
    }
}
