<div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-sm btn-warning" data-coreui-toggle="modal"
        data-coreui-target="#productEditModal{{ $product->id }}">
        <i class="text-white fa-solid fa-pen"></i>
    </button>
    <!-- Modal -->
    <div wire:ignore.self class="modal modal-xl fade" id="productEditModal{{ $product->id }}" tabindex="-1"
        aria-labelledby="productEditModal{{ $product->id }}Label" aria-hidden="true" data-coreui-backdrop="static"
        data-coreui-keyboard="false">
        <form wire:submit="updateProduct">
            <div class="modal-dialog" x-data="{ uploading: false, progress: 0 }">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="productEditModal{{ $product->id }}Label">{{ $product->name }}:
                            {{ __('edit') }} {{ __('details') }}</h5>
                    </div>
                    <!-- Main Body -->
                    <div class="modal-body">

                        <!-- Details -->
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <input type="hidden" name="id" value="{{ $product->id }}" />
                                <div class="form-group @error('name')) has-error @endif">
                                    <label for="name">{{ __('Name') }} *</label>
                                    <input wire:model="name" type="text" class="form-control" id="name"
                                        autocomplete="off" placeholder="{{ __('Enter name') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                    <div class="form-group @error('description')) has-error @endif">
                                    <label for="description">{{ __('Description') }} *</label>
                                    <input wire:model="description" type="text" class="form-control" id="description"
                                        autocomplete="off" placeholder="{{ __('Enter description') }}" />
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6 col-md-2">
                                        <div class="form-group  @error('price')) has-error @endif">
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
                                    <label for="newPhoto" class="form-label">{{ __('Photo') }}
                                    </label>
                                    <input id="newPhoto" name="newPhoto" type="file"
                                        wire:model.live="newPhoto"
                                        class="form-control @error('newPhoto') is-invalid @enderror"
                                        accept="image/png, image/jpg, image/jpeg, image/gif" />

                                    @error('newPhoto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <div x-show="uploading">
                                        <progress max="100"
                                            x-bind:value="progress"></progress>
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

                                <div class="text-center card border-top-3 border-top-primary">
                                    <div class="card-header">
                                        <p class="card-text">{{ __('Current Photo') }}</p>
                                    </div>
                                    <div class="card-body align-content-center">
                                        @if ($photo)
                                            <img src="{{ $photo }}" alt="Attuale"
                                                class="mt-2 card-img-top img-thumbnail"
                                                width="150" />
                                        @else
                                            <div class="badge bg-warning">{{ __('No photo') }}</div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-primary w-100"
                            x-show="!uploading">{{ __('save') }}</button>
                    </div>
                    <!-- End Details -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-coreui-dismiss="modal">{{ __('close') }}</button>

                    </div>
                </div>

            </div>
        </form>
    </div>

</div>
