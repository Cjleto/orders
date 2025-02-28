<div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-sm btn-warning" data-coreui-toggle="modal"
        data-coreui-target="#dishEditModal{{ $dish->id }}">
        <i class="text-white fa-solid fa-pen"></i>
    </button>
    <form wire:submit="updateDish">
    <!-- Modal -->
    <div wire:ignore.self class="modal modal-xl fade" id="dishEditModal{{ $dish->id }}" tabindex="-1"
        aria-labelledby="dishEditModal{{ $dish->id }}Label" aria-hidden="true" data-coreui-backdrop="static"
        data-coreui-keyboard="false">
        <div class="modal-dialog" x-data="{ uploading: false, progress: 0 }">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dishEditModal{{ $dish->id }}Label">{{ $dish->name }}:
                        {{ __('Edit') }} {{ __('details') }}</h5>
                </div>
                <!-- Main Body -->
                <div class="modal-body">
                    <div class="mt-2 container-fluid">
                        <div class="p-3 mb-3 card text-bg-light border-top-primary border-top-3">
                            <div class="gap-3 text-center card-header d-flex justify-content-start">
                                <h4>{{ Str::title(__('new') . ' ' . __('dish') . ' ' . __('details')) }}</h4>
                                <div class='offcanvas_container'>
                                    <x-category-list-offcanvas target="offcanvasRight" label="Toggle right offcanvas"
                                        :category="$dish->category" :subCategory="$dish->subCategory" />
                                </div>
                            </div>

                            <div class="card-body">

                                <!-- Category settings -->
                                <div>
                                    <p class="gap-1 d-flex justify-content-end">
                                        <button class="btn btn-outline-warning" type="button"
                                            data-coreui-toggle="collapse"
                                            data-coreui-target="#collapseCategorySettings" aria-expanded="false"
                                            aria-controls="collapseCategorySettings" ">
                                            {{ __('Change Category') }}
                                        </button>
                                    </p>
                                    <div class="collapse" id="collapseCategorySettings" wire:ignore.self>
                                        <div class="mb-2 card card-body">
                                            <div class="mt-1 mb-2 row form-group">
                                                <div class="mb-2 col-12 col-md-4">
                                                    <label class="form-label"
                                                        for="selected_macro_id_category_id">{{ __('Macro Category') }} *</label>
                                                    <select wire:model.live="selected_macro_id" class="form-select"
                                                        id="selected_macro_id_category_id" aria-label="Select Macro">
                                                        <option value="">Select a {{ __('Macro Category') }}</option>
                                                        @foreach ($availableMacroCategories as $macro_category)
                                                            <option value="{{ $macro_category->id }}">
                                                                {{ $macro_category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('selected_macro_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        @if ($selected_macro_id)
                                            <div class="mb-2 col-12 col-md-4">
                                                <label class="form-label"
                                                    for="selected_category_id_id">{{ __('Category') }} *</label>
                                                <select wire:model.live="selected_category_id" class="form-select"
                                                    id="selected_category_id_id">
                                                    <option value="">Select a category</option>
                                                    @foreach ($availableCategories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('selected_category_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            @if ($selected_category_id)
                                                <div class="mb-2 col-12 col-md-4">
                                                    <label class="form-label"
                                                        for="selected_sub_category_id_id">{{ __('SubCategory') }}
                                                        *</label>
                                                    <select wire:model.live="selected_sub_category_id" class="form-select"
                                                        id="selected_sub_category_id_id">
                                                        <option value="">{{ __('Choose a sub category') }}
                                                        </option>
                                                        <option value=0>{{ __('No sub category') }}</option>
                                                        @foreach ($availableSubCategories as $subCategory)
                                                            <option value="{{ $subCategory->id }}">
                                                                {{ $subCategory->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('selected_sub_category_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            @endif
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- End Category settings -->



                    <!-- Details -->
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
                                <input wire:model="price" type="number" step=".01" class="form-control" id="price"
                                    autocomplete="off" placeholder="{{ __('Enter price') }}">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-2 row">
                        <div class="col-12">
                            <div
                                x-on:livewire-upload-start="uploading = true"
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
                                        @if ($photo)
                                            <img src="{{ $photo }}" alt="Attuale"
                                                class="card-img-topmt-2 img-thumbnail" width="150" />
                                        @else
                                            <div class="badge bg-warning">{{ __('No photo') }}</div>
                                        @endif

                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-primary w-100"
                        x-show="!uploading"
                        >{{ __('Save') }}</button>
                </div>
                <!-- End Details -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>

        </div>
    </div>
    </form>

</div>
