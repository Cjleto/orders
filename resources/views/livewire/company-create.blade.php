<div>
    @if ($availableManagers->count() < 1)
        <div class="alert alert-danger">
            Non ci sono manager disponibili
            <br>
            Creane uno nuovo => <a href="{{ route('users.create') }}" class=" link-info text-decoration-none">Crea Manager</a>
        </div>
    @endif
    <form wire:submit.prevent="save" @class([
        'd-none' => $availableManagers->count() < 1,
    ])>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="mb-3 row">
            <div class="col-12 col-md-6">
                <label for="user_id" class="form-label">Manager * </label>

                <select id="user_id" wire:model="user_id" class="form-select @error('user_id') is-invalid @enderror">
                    <option value="">Seleziona un manager</option>
                    @foreach ($availableManagers as $manager)
                        <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 col-md-6">
                <label for="expiration_date" class="form-label">Data di scadenza *</label>
                <input id="expiration_date" name="expiration_date" type="date" format="yyyy-MM-dd"
                    min="{{ now()->add('1 day')->format('Y-m-d') }}" wire:model.live="expiration_date"
                    class="form-control
                    @error('expiration_date') is-invalid @enderror">
                @error('expiration_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>



        <div class="row">
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Name *</label>
                    <input id="name" type="text" wire:model.live="name"
                        class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="address" class="form-label">Address *</label>
                    <input id="address" type="text" wire:model="address"
                        class="form-control @error('address') is-invalid @enderror">
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug *</label>
                    <input id="slug" type="text" wire:model="slug"
                        class="form-control @error('slug') is-invalid @enderror">
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="slug" class="form-label">Tipologia *</label>
                    <select id="type" wire:model="type" class="form-select @error('type') is-invalid @enderror">
                        <option value="">Seleziona una tipologia</option>
                        @foreach ($types as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mb-2 card border-primary">
            <div class="card-body">
                <h4 class="card-title">Social Data</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="google_review_link" class="form-label">Google review link *</label>
                            <input id="google_review_link" type="text" wire:model="google_review_link"
                                class="form-control @error('google_review_link') is-invalid @enderror">
                            @error('google_review_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="facebook_link" class="form-label">Facebook link *</label>
                            <input id="facebook_link" type="text" wire:model="facebook_link"
                                class="form-control @error('facebook_link') is-invalid @enderror">
                            @error('facebook_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="instagram_link" class="form-label">Instagram link *</label>
                            <input id="instagram_link" type="text" wire:model="instagram_link"
                                class="form-control @error('instagram_link') is-invalid @enderror">
                            @error('instagram_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="site_link" class="form-label">Site link *</label>
                            <input id="site_link" type="text" wire:model="site_link"
                                class="form-control @error('site_link') is-invalid @enderror">
                            @error('site_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description *</label>
            <textarea id="description" wire:model="description" class="form-control @error('description') is-invalid @enderror"></textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="logo" class="form-label">Logo *</label>
            <input id="logo" name="logo" type="file" wire:model="logo"
                class="form-control @error('logo') is-invalid @enderror"
                accept="image/png, image/jpg, image/jpeg, image/gif">
            @error('logo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            @if ($logo)
                <img src="{{ $logo->temporaryUrl() }}" alt="Preview" class="mt-2 img-thumbnail" width="150">
            @endif
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Crea Ristorante</button>
        </div>
    </form>


    {{--
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.addEventListener('swal:modal', event => {
        Swal.fire({
            title: event.detail[0].title,
            text: event.detail[0].text,
            icon: event.detail[0].type,
            confirmButtonText: 'Chiudi',
            timer: 3000,
            timerProgressBar: true,
            willClose: () => {
                Livewire.dispatch('redirectConfirmed');
            }
        })
    })
</script> --}}

</div>
