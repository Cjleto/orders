<?php

namespace App\Livewire;

use App\Models\Company;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\CompanyService;
use Barryvdh\Debugbar\Facades\Debugbar;

class PreviewMenu extends Component
{

    public Company $company;
    public $menuMap;
    /* public $backgroundOpacity; */
    public $selectedTemplate = 'template1'; // Template predefinito
    private $companyService;
    public $selectedFont;
    public $selectedSecondaryFont;
    public $hideStaticCssElements = true;
    public $background_color;

    public function mount(Company $company)
    {

        $this->company = $company;

        /*   $this->menuSetting = $company->menuSetting;
        Debugbar::info("da public menu: ");
        Debugbar::info($this->menuSetting); */

        /* $this->backgroundOpacity = $this->menuSetting->background_opacity ?? 1; */
        $this->selectedTemplate = $this->menuSetting->template ?? 'template1';
        $this->selectedFont = $this->menuSetting->selected_font ?? 'Roboto';
        $this->selectedSecondaryFont = $this->menuSetting->selected_font_secondary ?? 'Roboto';
        $this->background_color = $this->menuSetting->background_color ?? '#ffffff';


    }

    public function boot()
    {
        $this->companyService = new CompanyService();
        $this->menuSetting();
        /* $this->menuWallpaper(); */
        $this->menuMap = $this->companyService->getMenumap($this->company);
        Debugbar::info($this->menuSetting());
    }

    #[Computed]
    public function enableLanguageSwitcher(): bool
    {
        return config('myconst.translate_enabled');
    }

    #[Computed]
    public function menuSetting()
    {
        return $this->company?->menuSetting;
    }

    /* #[Computed]
    public function menuWallpaper()
    {
        return $this->menuSetting?->menuWallpaper;
    } */

    #[Computed]
    public function logo()
    {
        return $this->company?->getFirstMediaUrl('logo', 'thumb_sharp');
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

    #[On('refreshMenuSettings')]
    public function test()
    {
        $this->menuSetting();
        $this->mount($this->company);
        Debugbar::info('refreshMenuSettings on preview');
    }

    #[On('template-changed')]
    #[On('primary-color-changed')]
    #[On('secondary-color-changed')]
    #[On('background-color-changed')]
    #[On('changedSetting')]
    public function changedSetting(array $data)
    {
        $this->resetData($data);
    }

    public function resetData (array $data)
    {

        Debugbar::info('resetData');
        Debugbar::info($data);

        $this->selectedTemplate = $data['template'];
        $this->menuSetting()->template = $data['template'];
        $this->menuSetting()->primary_color = $data['primary_color'];
        $this->menuSetting()->secondary_color = $data['secondary_color'];
        $this->menuSetting()->tertiary_color = $data['tertiary_color'];
        $this->menuSetting()->quaternary_color = $data['quaternary_color'];
        $this->menuSetting()->background_color = $data['background_color'];

        $this->menuMap = $this->companyService->getMenumap($this->company);
    }


    public function render()
    {

        return view('livewire.preview-menu', [
            'template' => $this->selectedTemplate
        ]);
    }
}
