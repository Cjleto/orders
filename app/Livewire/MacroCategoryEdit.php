<?php

namespace App\Livewire;

use App\Models\Company;
use Livewire\Component;
use App\Enums\IsVisible;
use App\Helpers\LivewireSwal;
use App\Models\MacroCategory;
use Illuminate\Validation\Rule;
use App\Rules\MacroCategoryName;
use App\Http\Services\CompanyService;
use App\Events\TranslatableUpdatedEvent;

class MacroCategoryEdit extends Component
{

    public MacroCategory $macro_category;
    public $name;
    public $description;
    public $company_id;
    public $is_visible = IsVisible::VISIBLE;

    protected $listeners = [
        'redirectConfirmed'
    ];

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                new MacroCategoryName(Company::find($this->company_id), $this->macro_category),
            ],
            'description' => 'required|string|max:255',
            'is_visible' => [
                'required',
                Rule::enum(IsVisible::class),
            ],
        ];
    }

    public function mount ()
    {
        $this->name = $this->macro_category->name;
        $this->description = $this->macro_category->description;
        $this->is_visible = $this->macro_category->is_visible;
        $this->company_id = $this->macro_category->company_id;

    }

    public function save()
    {
        $validated = $this->validate($this->rules());

        $toTranslate = array_filter($this->macro_category->getTranslatableFields(), function($field) {
            return $this->macro_category->$field != $this->$field;
        });

        $this->macro_category->update([
            'name' => $this->name,
            'description' => $this->description,
            'is_visible' => $this->is_visible,
        ]);

        foreach ($toTranslate as $field) {

            // verifica se la proprietà è stata modificata
            event(new TranslatableUpdatedEvent($this->macro_category, $field));
        }

        (new CompanyService)->forgetMenuMap($this->macro_category->company);

        LivewireSwal::make($this)
            ->success()
            ->setParams([
                'title' => 'Successo!',
                'text' => 'Macro modificata con successo.',
                'emit' => 'redirectConfirmed',
            ])
            ->fireSwalEvent();

        $this->reset([
            'name',
            'description',
            'is_visible',
        ]);
    }

    public function redirectConfirmed()
    {
        return redirect()->route('macro_categories.show', ['macro_category' => $this->macro_category->id]);
    }


    public function render()
    {
        return view('livewire.macro-category-edit');
    }
}
