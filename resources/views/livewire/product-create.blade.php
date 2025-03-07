<div>

    <div class="mt-2 container-fluid">

        <div class="mb-2 d-flex justify-content-end">
            <a href="{{ route('products.index') }}" class="btn btn-primary">{{ __('Go Back') }}</a>
        </div>

        <div class="p-3 mb-3 card text-bg-light border-top-primary border-top-3" x-data="{ uploading: false }">
            <div class="gap-3 text-center card-header d-flex justify-content-start">
                <h4>{{ Str::title(__('new') . ' ' . __('product') . ' ' . __('details')) }}</h4>

            </div>
            <form wire:submit.prevent="storeProduct">

                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="form-group
                                @error('name')) has-error @endif">
                                <label for="name">{{ __('Name') }} *</label>
                                <input wire:model="name" type="text" class="form-control" id="name"
                                    autocomplete="off" placeholder="{{ __('Enter name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6 col-md-2">

                                <div class="form-group @if ($errors->has('stock')) has-error @endif">
                                    <label for="stock">{{ __('Stock') }} *</label>
                                    <input wire:model="stock" type="number" class="form-control" id="stock"
                                        autocomplete="off" placeholder="{{ __('Enter stock') }}" />
                                    @error('stock')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 col-md-2">
                                <div
                                    class="form-group
                                @if ($errors->has('price')) has-error @endif">
                                    <label for="price">{{ __('Price') }} *</label>
                                    <input wire:model="price" type="number" step=".01" class="form-control"
                                        id="price" autocomplete="off" placeholder="{{ __('Enter price') }}">
                                    @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-2 row">
                            <div class="col-12">
                                <div class="form-group @if ($errors->has('description')) has-error @endif">
                                    <label for="description">{{ __('Description') }} *</label>
                                    <input wire:model="description" type="text" class="form-control" id="description"
                                        autocomplete="off" placeholder="{{ __('Enter description') }}" />
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-2 row">
                            <div class="col-12">
                                <div x-on:livewire-upload-start="uploading = true"
                                    x-on:livewire-upload-finish="uploading = false"
                                    x-on:livewire-upload-cancel="uploading = false"
                                    x-on:livewire-upload-error="uploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <label for="newPhoto" class="form-label">{{ __('Photo') }} </label>
                                    <input id="newPhoto" name="newPhoto" type="file" wire:model="newPhoto"
                                        class="form-control @error('newPhoto') is-invalid @enderror"
                                        accept="image/png, image/jpg, image/jpeg, image/gif" />

                                    @error('newPhoto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <div x-show="uploading">
                                        <progress max="100" x-bind:value="progress"></progress>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="mt-2 row">
                            <div class="col-6">
                                @if ($newPhoto)
                                    <div class="text-center card border-top-3 border-top-warning">
                                        <div class="card-header">
                                            <p class="card-text">{{ __('New Photo') }}</p>
                                        </div>
                                        <div class="card-body align-items-center">
                                            @if ($newPhoto && !$errors->has('newPhoto'))
                                                <img src="{{ $newPhoto->temporaryUrl() }}" alt="Preview"
                                                    class="mt-2 img-thumbnail" width="150">
                                            @else
                                                <p>No preview available.</p>

                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @error('newPhoto')
                                    <div class="invalid-feedback">{{ $message }}s</div>
                                @enderror


                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-primary w-100" x-show="!uploading"
                            data-coreui-dismiss="modal">{{ __('save') }}</button>
                    </div>

            </form>
        </div>
    </div>
</div>
