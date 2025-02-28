<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MenuSetting;
use Livewire\Attributes\On;
use App\Helpers\LivewireSwal;
use Livewire\WithFileUploads;
use App\Http\Dtos\MenuSettingDto;
use Illuminate\Support\Facades\Auth;
use App\Http\Actions\CreateMenuSettingAction;
use App\Http\Requests\MenuSettingRequest;
use Barryvdh\Debugbar\Twig\Extension\Debug;
use Debugbar;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MenuSettingsForm extends Component
{
    use WithFileUploads;

    public ?MenuSetting $menuSetting = null;

    public $company_id;
    public $primary_color = '#000000';
    public $secondary_color = '#540000';
    public $tertiary_color = '#000000';
    public $quaternary_color = '#000000';
    public string $menuWallpaperUrl;
    public $newMenuWallpaper;
    /* public $backgroundOpacity; */
    public $title;
    public $template = 'template3';
    public $selectedFont;
    public $selectedFontSecondary;
    public $textFooter;
    public $background_color;

    public function rules()
    {
        return (new MenuSettingRequest())->rules();
    }

    /* #[On('refreshMenuSettings')]
    public function test ()
    {
       Debugbar::info('test');
    } */

    public function mount()
    {
        $setting = Auth::user()->company->menuSetting;

        if($setting) {

            $this->menuSetting = $setting;
            $this->company_id = $setting->company_id;
            $this->primary_color = $setting->primary_color;
            $this->secondary_color = $setting->secondary_color;
            $this->tertiary_color = $setting->tertiary_color;
            $this->quaternary_color = $setting->quaternary_color;
            /* $this->menuWallpaper = $setting->menuWallpaper; */
            /* $this->backgroundOpacity = $setting->background_opacity; */
            $this->title = $setting->title;
            $this->template = $setting->template;
            $this->selectedFont = $setting->selected_font;
            $this->selectedFontSecondary = $setting->selected_font_secondary;
            $this->textFooter = $setting->text_footer;
            $this->background_color = $setting->background_color;

            $this->menuWallpaperUrl = $setting->getFirstMediaUrl('menu_wallpaper');
        }
    }

    private function getProperties(){
        return [
            'template' => $this->template,
            'primary_color' => $this->primary_color,
            'secondary_color' => $this->secondary_color,
            'tertiary_color' => $this->tertiary_color,
            'quaternary_color' => $this->quaternary_color,
            'background_color' => $this->background_color
        ];
    }

    public function updatedTemplate($value)
    {

        if(empty($value)) {
            return;
        }

        $this->dispatch('changedSetting', $this->getProperties());
    }

    public function updatedPrimaryColor ()
    {
        $this->dispatch('changedSetting', $this->getProperties());
    }

    public function updatedSecondaryColor()
    {
        $this->dispatch('changedSetting', $this->getProperties());
    }

    public function updatedBackgroundColor()
    {
        $this->dispatch('changedSetting', $this->getProperties());
    }

    public function updatedTertiaryColor()
    {
        $this->dispatch('changedSetting', $this->getProperties());
    }

    public function updatedQuaternaryColor()
    {
        $this->dispatch('changedSetting', $this->getProperties());
    }

    public function deleteMenuWallpaper ()
    {
        $this->menuSetting->clearMediaCollection('menu_wallpaper');
        $this->menuWallpaperUrl = '';
    }

    public function save(CreateMenuSettingAction $action)
    {
        $this->validate($this->rules());

        try {


            $dto = MenuSettingDto::fromArray(get_object_vars($this));

            $action->handle($dto);

            LivewireSwal::make($this)
                ->success()
                ->setParams([
                    'title' => 'Successo!',
                    'text' => 'Setting salvato con successo.',
                    'emit' => 'refreshMenuSettings'
                ])
                ->fireSwalEvent();

            $this->mount();

            $this->reset([
                'newMenuWallpaper'
            ]);

        } catch (\Exception $e) {

            LivewireSwal::make($this)
                ->error()
                ->setParams([
                    'title' => 'Errore!',
                    'text' => $e->getMessage(),
                ])
                ->fireSwalEvent();
            return;
        }
    }


    public function render()
    {
        return view('livewire.menu-settings-form');
    }
}
