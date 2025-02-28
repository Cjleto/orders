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

class MacroCategoryCreate extends Component
{

    public $name;
    public $description;
    public $company_id;
    public $is_visible = IsVisible::VISIBLE;
    public $companies;
    public $macro;
    public $hideCompanySelect = false;
    public $btnClass = 'btn btn-primary btn-sm';

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
                new MacroCategoryName(Company::find($this->company_id)),
            ],
            'description' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'is_visible' => [
                'required',
                Rule::enum(IsVisible::class),
            ],
        ];
    }

    public function mount()
    {
        $this->companies = Company::forAuthUser()->get();
        $this->hideCompanySelect = $this->companies->count() === 1;
        $this->company_id = $this->companies->first()->id;


    }

    public function store()
    {
        $validated = $this->validate($this->rules());

        $this->macro = MacroCategory::create([
            'name' => $this->name,
            'description' => $this->description,
            'company_id' => $this->company_id,
            'is_visible' => $this->is_visible,
        ]);

        $this->reset([
            'name',
            'description',
            'is_visible',
        ]);

        (new CompanyService)->forgetMenuMap($this->macro->company);

        session()->flash('success', "Macro {$this->macro->name} created successfully!");

        $this->dispatch('refreshMacroCategories');


    }

    public function redirectConfirmed()
    {
        return redirect()->route('macro_categories.show', ['macro_category' => $this->macro->id]);
    }

    public function render()
    {
        return view('livewire.macro-category-create');
    }
}
