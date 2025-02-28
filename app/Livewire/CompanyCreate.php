<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Enums\CompanyType;
use Illuminate\Support\Str;
use App\Helpers\LivewireSwal;
use App\Http\Dtos\CompanyDto;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use App\Rules\LivewireFileNameTooLong;
use Barryvdh\Debugbar\Facades\Debugbar;
use App\Http\Actions\CreateCompanyAction;

class CompanyCreate extends Component
{

    use WithFileUploads;

    public $name;
    public $description;
    public $address;
    public $logo;
    public $slug;
    public $availableManagers;
    public $user_id;
    public $company;
    public $expiration_date;
    public CompanyType $type;
    public $types;
    public $google_review_link;
    public $facebook_link;
    public $instagram_link;
    public $site_link;

    #[Locked]
    public $redirectUrl;

    protected $listeners = [
        'redirectConfirmed'
    ];

    public function rules()
    {

        return [
            'user_id' => 'required|exists:users,id',
            'name' => 'required|min:2|max:55',
            'description' => 'required|min:2|max:255',
            'address' => 'required|min:2|max:255',
            'logo' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048',
                new LivewireFileNameTooLong()
            ],
            'slug' => 'required|min:2|max:55|unique:companies,slug',
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

    public function mount()
    {

        $this->redirectUrl = url()->current();
        $this->availableManagers = User::managers()
            ->whereDoesntHave('company')
            ->get();

        $this->types = CompanyType::cases();
    }

    public function updatedName()
    {
        // Genera lo slug ogni volta che il nome viene aggiornato
        $this->slug = Str::slug($this->name);
    }


    public function save(CreateCompanyAction $action)
    {
        $validated = $this->validate($this->rules());

        $validated['expiration_date'] = Carbon::parse($validated['expiration_date']);

        $dto = CompanyDto::fromRequest($validated);

        try {
            $this->company = $action->handle($dto);

            LivewireSwal::make($this)
                ->success()
                ->setParams([
                    'title' => 'Success!',
                    'text' => 'Company created.',
                    'emit' => 'redirectConfirmed'
                ])
                ->fireSwalEvent();

            // Reimposta i campi
            $this->reset(['name', 'description', 'address', 'logo', 'slug', 'user_id', 'expiration_date', 'type']);
        } catch (\Exception $e) {
            //Alert::error('Errore', 'Si è verificato un errore durante la creazione del ristorante');
            LivewireSwal::make($this)
                ->error()
                ->setParams([
                    'title' => 'Error',
                    'text' => 'An error occurred while creating the dish',
                    'footer' => $e->getMessage()
                ])
                ->fireSwalEvent();

            Debugbar::error($e->getMessage());
        }
        // Crea il ristorante

    }

    public function redirectConfirmed()
    {
        return redirect($this->redirectUrl);
    }

    public function render()
    {
        return view('livewire.company-create');
    }
}
