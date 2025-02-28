<div>

    <!-- Button trigger modal -->
    <button type="button" class="{{ $btnClass }}" data-coreui-toggle="modal" data-coreui-target="#createSubCategoryModal">
        {{ __('Create') }} {{ __('Sub Category') }}
    </button>

    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <!-- Modal -->
    <div wire:ignore.self class="modal modal-xl fade" id="createSubCategoryModal" tabindex="-1"
        aria-labelledby="createSubCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-secondary" id="createSubCategoryModalLabel">{{ __('Creating') }}
                        {{ __('Sub Category') }} in
                        <span class="badge bg-info">{{ $category->name }}</span>
                    </h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="store">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    {{-- <div class="card-header">
                                        <h4 class="card-title">{{ __('Create Sub Category') }}</h4>
                                    </div> --}}
                                    <div class="card-body">
                                        @session('success')
                                            <div class="alert alert-success">{{ session('success') }}</div>
                                        @endsession
                                        <div class="row form-group">
                                            <div class="col-12 col-md-8">
                                                <label for="name" class="form-label">{{ __('Name') }} *</label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    id="name" wire:model="name">
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="is_visible" class="form-label">{{ __('Visibility') }}
                                                    *</label>
                                                <select wire:model="is_visible"
                                                    class="form-select @error('is_visible') is-invalid @enderror">
                                                    <option value="">{{ __('Select visibility') }}</option>
                                                    <option value="1">{{ __('Visible') }}</option>
                                                    <option value="0">{{ __('Invisible') }}</option>
                                                </select>
                                                @error('is_visible')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mt-2 row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="description" class="form-label">Description</label>
                                                    <textarea id="description" wire:model="description" class="form-control @error('description') is-invalid @enderror"></textarea>
                                                    @error('description')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                            <button wire:click='store' type="button"
                                class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
