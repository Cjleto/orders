<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;

class CompanySettings extends Component
{

    #[Computed]
    public function company(){
        return Auth::user()->company;
    }

    public function render()
    {
        return view('livewire.company-settings');
    }
}
