<?php

namespace App\Livewire;

use Carbon\Language;
use Livewire\Component;
use App\Enums\LanguageEnum;
use App\Models\Company;
use Debugbar;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\App;

class LanguageSwitcher extends Component
{
    public $selectedLanguage;
    public $company_id;

    public function mount ()
    {
        $this->selectedLanguage = session('app_locale', config('app.locale'));
        /* Debugbar::info('Locale attuale: ' . $this->selectedLanguage); */
    }

    #[Computed]
    public function availableLanguages()
    {
        return LanguageEnum::cases();
    }

    public function changeLanguage ($langCode)
    {
        $company = Company::findOrFail($this->company_id);
        $this->selectedLanguage = $langCode;

        session(['app_locale' => $this->selectedLanguage]);

        App::setLocale($this->selectedLanguage);

        return redirect()->route('public.menu', ['company' => $company]);
    }




    public function render()
    {
        return view('livewire.language-switcher');
    }
}
