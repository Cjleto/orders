<?php

namespace App\Livewire;

use App\Exceptions\WebRenderedException;
use Debugbar;
use App\Models\Company;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\CompanyService;

class PublicMenu extends Component
{

    public Company $company;
    public $menuMap;
    /* public $backgroundOpacity; */
    public $selectedFont;
    public $selectedSecondaryFont;
    public $template = 'template1'; // Template predefinito
    public $hideStaticCssElements = false;

    public function mount(Company $company)
    {
        $this->company = $company;
        $companyService = new CompanyService();
        $this->menuMap = $companyService->getMenumap($company);

        // se menuMap è vuoto, non esiste un menu per la company
        if ($this->menuMap->isEmpty()) {
            throw new WebRenderedException('Menu non trovato');
        }

        /* $this->backgroundOpacity = $this->menuSetting->background_opacity; */
        $this->selectedFont = $this->menuSetting->selected_font;
        $this->selectedSecondaryFont = $this->menuSetting->selected_font_secondary;
        $this->template = $this->menuSetting->template;

        app()->setLocale(session('app_locale', config('app.locale')));

    }

    public function boot ()
    {
        $this->menuSetting();
        $this->menuWallpaper();
    }

    #[Computed]
    public function enableLanguageSwitcher(): bool
    {
        return config('myconst.translate_enabled');
    }

    #[Computed]
    public function menuSetting ()
    {
        return $this->company->menuSetting;
    }

    #[Computed]
    public function menuWallpaper ()
    {
        return $this->menuSetting->menuWallpaper;
    }

    #[Computed]
    public function logo ()
    {
        return $this->company->getFirstMediaUrl('logo', 'thumb');
    }

    #[Computed]
    public function logoSplash()
    {
        return $this->company->getFirstMediaUrl('logo');
    }

    #[Computed]
    public function socialsLinks()
    {

        return [
            'google_review_link' => $this->company->google_review_link,
            'facebook_link' => $this->company->facebook_link,
            'instagram_link' => $this->company->instagram_link,
            'site_link' => $this->company->site_link,
        ];
    }

    /* public function refreshMenu ()
    {
        $this->mount($this->company);
        Debugbar::info('refreshMenuSettings on publicmenu');
    } */


    public function render()
    {

        Debugbar::info($this->menuMap);

        return view('livewire.public-menu', [
            'template' => $this->template
        ])->layout('layouts.public');
    }
}
