<div>


    <div class="mt-2 container-fluid">
        {{-- <div wire:loading wire:target="@this.storeDish">

            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%"
                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div> --}}

        <div class="p-3 mb-3 card text-bg-light border-top-primary border-top-3" x-data="{ uploading: false }">
            <div class="gap-3 text-center card-header d-flex justify-content-start">
                <h4>{{ Str::title(__('new') . ' ' . __('dish') . ' ' . __('details')) }}</h4>


                <div class='offcanvas_container'>
                    <x-category-list-offcanvas target="offcanvasRight" label="Toggle right offcanvas" :category="$category"
                        :subCategory="$subCategory" />
                </div>

            </div>
            <form wire:submit.prevent="storeDish">

                {{-- <div wire:loading>

                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%"
                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div> --}}

                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div
                                class="form-group
                                @if ($errors->has('name')) has-error @endif">
                                <label for="name">{{ __('Name') }} *</label>
                                <input wire:model="name" type="text" class="form-control" id="name"
                                    autocomplete="off" placeholder="{{ __('Enter name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group @if ($errors->has('description')) has-error @endif">
                                <label for="description">{{ __('Description') }} @if(!config('myconst.dish_description_can_be_empty'))*@endif</label>
                                <input wire:model="description" type="text" class="form-control" id="description"
                                    autocomplete="off" placeholder="{{ __('Enter description') }}" />
                                @error('description')
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
                                        <img src="{{ $newPhoto->temporaryUrl() }}" alt="Preview"
                                            class="mt-2 img-thumbnail" width="150">
                                    </div>
                                </div>
                            @endif
                            @error('newPhoto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror


                        </div>
                        <div class="col-6">
                            @if ($dish)
                                <div class="text-center card border-top-3 border-top-primary">
                                    <div class="card-header">
                                        <p class="card-text">{{ __('Current Photo') }}</p>
                                    </div>
                                    <div class="card-body align-content-center">
                                        <img src="{{ $photo }}" alt="Attuale"
                                            class="card-img-topmt-2 img-thumbnail" width="150">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-primary w-100" x-show="!uploading"
                        data-coreui-dismiss="modal">{{ __('Save') }}</button>
                </div>

            </form>
        </div>
    </div>
</div>
