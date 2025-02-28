<div>
    <nav class="navbar navbar-light text-secondary">
        <div class="container-fluid d-flex justify-content-between">
            <div class="gap-2 d-flex justify-content-start align-items-center">
                <div class="fs-3"><i class="fas fa-list me-2"></i>{{ __('Macro Categories') }}</div>
            </div>
            <div class="">
                <livewire:helpinfo.general-crud :type="'macro'" />
            </div>
        </div>
    </nav>

    <div class="mb-4 card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>{{ __('Macro Categories') }}</div>
            <livewire:macro_category_create>
        </div>

        <div class="card-body">
            <ol class="mt-2 list-group list-group-flush" wire:sortable="updateMacroCategoryOrder">
                @foreach ($macro_categories as $macro_category)
                    <li class="list-group-item d-flex justify-content-between align-items-start"
                        wire:sortable.item="{{ $macro_category->id }}"
                        wire:key="macro_category-{{ $macro_category->id }}">
                        <div class="ms-2 me-auto d-flex justify-content-start">
                            <div class="me-2" wire:sortable.handle role="button">
                                <i class="fa-solid fa-sort"></i>
                            </div>
                            <div class="d-flex flex-column">
                                <div class="fw-bold">{{ $macro_category->name }}</div>
                                <span class="text-muted fs-6">{{ $macro_category->description }}</span>
                                <div class="gap-1 d-flex justify-content-start align-items-center">
                                    <x-common.badge-category :categories_count="$macro_category->categories_count" :macro_category="$macro_category" />
                                    {{-- <x-common.badge-dishes :category="$macro_category->categories()->first()" :dishes_count="$macro_category->dishes_count" /> --}}
                                </div>
                            </div>
                        </div>

                        <div class="gap-2 d-flex">
                            {{-- <a href="{{ route('macro_categories.show', $macro_category) }}" class="btn btn-sm btn-info"
                                data-coreui-toggle="tooltip" data-coreui-placement="top"
                                data-coreui-custom-class="custom-tooltip" data-coreui-title="{{ __('Show') }}">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-search') }}"></use>
                                </svg>
                            </a> --}}
                            <a href="{{ route('macro_categories.edit', $macro_category) }}"
                                class="btn btn-sm btn-warning" data-coreui-toggle="tooltip" data-coreui-placement="top"
                                data-coreui-custom-class="custom-tooltip" data-coreui-title="{{ __('Edit') }}">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-pencil') }}"></use>
                                </svg>
                            </a>
                            <livewire:translation-show-list :model="$macro_category"
                                            :wire:key="'translations-component-'.$macro_category->id"  />
                            <livewire:togglevisible :model="$macro_category" :wire:key="$macro_category->id">
                            <livewire:macro-category-delete :macroCategory="$macro_category" :wire:key="'macro-category-delete-'.$macro_category->id" />
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>

        <div class="card-footer">
            {{-- {{ $macro_categories->links() }} --}}
        </div>
    </div>

</div>
