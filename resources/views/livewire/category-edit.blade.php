<div class="p-2 card">

    <div class="mb-2 row card-header">
        <div class="col-12 d-flex justify-content-center align-items-center">
                Stai modificando la categoria <div class="badge bg-primary ms-2 me-2">{{ $category->name }}</div> per <div
                    class="badge bg-pink ms-2">{{ $category->macroCategory->name }}</div>
        </div>
    </div>


    <div class="card-body">
        <form wire:submit.prevent="save">

            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            wire:model="name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-4 col-md-2">
                    <label for="is_visible" class="form-label">{{ __('Visibility') }}</label>
                    <select wire:model="is_visible" class="form-select @error('is_visible') is-invalid @enderror">
                        <option value="">{{ __('Select visibility') }}</option>
                        <option value="1">{{ __('Visible') }}</option>
                        <option value="0">{{ __('Invisible') }}</option>
                    </select>
                </div>

                <div class="col-4 col-md-2">
                    <label for="hide_price" class="form-label">{{ __('Hide Dish Price') }}</label>
                    <select wire:model="hide_price" class="form-select @error('hide_price') is-invalid @enderror">
                        <option value="0">{{ __('Show') }}</option>
                        <option value="1">{{ __('Hide') }}</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">{{ __('Description') }}</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" wire:model="description"></textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </form>
    </div>


</div>
