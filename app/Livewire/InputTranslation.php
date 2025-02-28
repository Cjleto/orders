<?php

namespace App\Livewire;

use Debugbar;
use Livewire\Component;
use App\Enums\LanguageEnum;
use App\Helpers\LivewireSwal;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use App\Interfaces\TranslatorInterface;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Lazy;


class InputTranslation extends Component
{

    public Model $model;
    public string $field;
    public string $text;
    public LanguageEnum $locale;
    public $enableButton;

    public function mount ()
    {

        $this->text = $this->model->getTranslatedValue($this->field, $this->locale->value) ?? '';
        $this->enableButton = strlen($this->text) > 0;


    }

    public function updatedText ($value)
    {
        $this->enableButton = strlen($this->text) > 0;
    }

    #[On('save_translations.{model.id}')]
    public function save ()
    {

        if($this->text === '') {
            return;
        }

        $this->model->translations()->updateOrCreate(
            [
                'locale' => $this->locale->value,
                'field' => $this->field
            ],
            [
                'value' => $this->text
            ]
        );


        $this->model->setTranslatedValue(
            field: $this->field,
            value: $this->text,
            locale: $this->locale->value
        );

        $this->dispatch('reload_translations.'.$this->model->id);

    }



    public function translateLive ()
    {
        $translator = app('App\Interfaces\TranslatorInterface');

        $newText = $translator->translate('it', $this->locale->value, $this->text);
        $this->text = $newText;

    }

    public function render()
    {
        return view('livewire.input-translation');
    }
}
