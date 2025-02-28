<?php

namespace App\Livewire;


use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Company;
use Livewire\Component;
use App\Enums\CompanyType;
use App\Helpers\LivewireSwal;
use App\Http\Dtos\CompanyDto;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Computed;
use App\Rules\LivewireFileNameTooLong;
use Barryvdh\Debugbar\Facades\Debugbar;
use App\Http\Actions\UpdateCompanyAction;


class CompanyEdit extends Component
{

    use WithFileUploads;

    public Company $company;
    public $name;
    public $address;
    public $description;
    public $slug;
    public $user_id;
    public $expiration_date;
    public $availableManagers;
    public $logo;
    public $newLogo = null;
    public $types;
    public $type;
    public $google_review_link;
    public $facebook_link;
    public $instagram_link;
    public $site_link;

    #[Locked]
    public $redirectUrl;

    #[Locked]
    #[Computed]
    public function excludeFields()
    {
        // in caso di update da parte del manager, non deve poter cambiare la scadenza
        $fields = Auth::user()->isManager() ?
            ['user_id', 'expiration_date'] :
            [];

        return $fields;
    }

    public function updatedNewLogo ()
    {
        $this->validate([
            'newLogo' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048',
                new LivewireFileNameTooLong()
            ]
        ]);
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'name' => 'required|min:2|max:55',
            'description' => 'required|min:2|max:255',
            'address' => 'required|min:2|max:255',
            'newLogo' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048',
                new LivewireFileNameTooLong()
            ],
            'slug' => [
                'required',
                'min:2',
                'max:55',
                'unique:companies,slug,' . $this->company->id
            ],
            'expiration_date' => 'nullable|date|after:today',
            'type' => [
                'required',
                Rule::enum(CompanyType::class)
            ],
            'google_review_link' => ['nullable', 'max:500', 'url'],
            'facebook_link' => ['nullable', 'max:500', 'url'],
            'instagram_link' => ['nullable', 'max:500', 'url'],
            'site_link' => ['nullable', 'max:500', 'url'],
        ];
    }

    protected $listeners = [
        'redirectConfirmedUpdated'
    ];

    public function mount($company = null)
    {

        $this->redirectUrl = url()->current();
        Debugbar::info($this->redirectUrl);
        if ($company) {
            $this->company = $company;
            $this->name = $company->name;
            $this->address = $company->address;
            $this->description = $company->description;
            $this->slug = $company->slug;
            $this->user_id = $company->user->id;
            $this->expiration_date = $company->expiration_date ? $company->expiration_date->format('Y-m-d') : null;
            $this->logo = $company->getFirstMediaUrl('logo');
            $this->newLogo = null;
            $this->type = $company->type;
            $this->google_review_link = $company->google_review_link;
            $this->facebook_link = $company->facebook_link;
            $this->instagram_link = $company->instagram_link;
            $this->site_link = $company->site_link;
        }

        $this->availableManagers = User::managers()->get();
        $this->types = CompanyType::cases();
    }

    public function save(UpdateCompanyAction $action)
    {

        $validated = $this->validate($this->rules());

        $validated['expiration_date'] = Carbon::parse($validated['expiration_date']);
        $validated['logo'] = $validated['newLogo'];

        $dto = CompanyDto::fromRequest($validated);

        // Aggiorna il ristorante con i dati validati

        $this->company = $action->handle($this->company, $dto);

        $this->reset([
            'name',
            'description',
            'address',
            'slug',
            'expiration_date',
            'user_id',
            'type',
            'newLogo'

        ]);

        LivewireSwal::make($this)
            ->success()
            ->setParams([
                'title' => 'Success!',
                'text' => 'Company modified.',
                'emit' => 'redirectConfirmedUpdated'
            ])
            ->fireSwalEvent();
    }

    public function redirectConfirmedUpdated()
    {
        return redirect($this->redirectUrl);
    }

    public function render()
    {
        return view('livewire.company-edit');
    }
}
