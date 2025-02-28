<div class="mb-2">

    <x-common.category-breadcrumb :initial_macro="$macro_category" />

    <nav class="navbar navbar-light text-secondary">
        <div class="container-fluid d-flex justify-content-between">
            <div class="gap-2 d-flex justify-content-start align-items-center">
                <div class="fs-3"><i class="fas fa-list me-2 "></i>{{ $macro_category->name }}</div>
                <livewire:togglevisible :model="$macro_category" :wire:key="$macro_category->name">
            </div>
            <div class="d-flex align-items-center">
                <span
                    class="p-0 me-2 text-end text-muted text-secondary fs-6 d-none d-md-inline">{{ $macro_category->description }}</span>
                    <livewire:helpinfo.general-crud :type="'category'" />
            </div>
        </div>
    </nav>

    <div class="col-12 ">
        {{-- <div class="gap-2 fs-3 d-flex align-items-center justify-content-between">
            <div class="d-flex flex-column">
                <div class="p-0 m-0 d-flex align-items-center">
                    <i class="fas fa-list me-2"></i> <!-- Aggiunto margine solo a destra dell'icona -->
                    <span class="p-0 m-0">{{ $macro_category->name }}</span>
                </div>
                <span class="p-0 m-0 text-end text-muted fs-6">{{ $macro_category->description }}</span>
            </div>
            <div>
                <i class="fa-regular fa-circle-question fs-4 text-warning"
                data-coreui-toggle="tooltip" data-coreui-placement="top"
                data-coreui-custom-class="custom-tooltip"
                data-coreui-title="{{ __("DragDropOrder") }}"></i>
            </div>
        </div> --}}

        <div class="card card-secondary">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>{{ __('Categories') }}</div>
                <livewire:category_create :macro_category="$macro_category">
            </div>
            <div class="card-body">
                <ol class="mt-2 overflow-auto list-group list-group-flush" wire:sortable="updateCategoryOrder" wire:ignore>
                    @forelse ($paginatedCategories as $category)
                        <li class="list-group-item d-flex justify-content-between align-items-start"
                            wire:sortable.item="{{ $category->id }}" wire:key="category-{{ $category->id }}">
                            <div class="ms-2 me-auto d-flex justify-content-start">
                                <div class="me-2" wire:sortable.handle role="button">
                                    <i class="fa-solid fa-sort"></i>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="fw-bold">{{ $category->name }}</div>
                                    <span class="text-muted fs-6">{{ $category->description }}</span>
                                    <div class="gap-1 d-flex justify-content-start align-items-center">
                                        <x-common.badge-sub-categories :category="$category" :sub_categories_count="$category->sub_categories_count" />
                                        <x-common.badge-dishes :category="$category" :dishes_count="$category->dishes_count" />
                                    </div>
                                </div>
                            </div>

                            <div class="gap-2 d-flex">
                                <a href="{{ route('categories.show', $category) }}" class="btn btn-sm btn-info"
                                    data-coreui-toggle="tooltip" data-coreui-placement="top"
                                    data-coreui-custom-class="custom-tooltip" data-coreui-title="{{ __('Show') }}">
                                    <svg class="icon">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-search') }}"></use>
                                    </svg>
                                </a>
                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning"
                                    data-coreui-toggle="tooltip" data-coreui-placement="top"
                                    data-coreui-custom-class="custom-tooltip" data-coreui-title="{{ __('Edit') }}">
                                    <svg class="icon">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-pencil') }}"></use>
                                    </svg>
                                </a>
                                <livewire:translation-show-list :model="$category"
                                            :wire:key="'translations-component-'.$category->id"  />
                                <livewire:togglevisible :model="$category" :wire:key="$category->id" />
                                <livewire:category-delete :category="$category" :wire:key="'category-delete-'.$category->id" />
                            </div>
                        </li>
                    @empty
                        <div class="d-flex align-self-center">
                            <x-common.badge-no-results>Nessuna category
                                configurata</x-common.badge-no-results>
                        </div>
                    @endforelse
                </ol>
                {{ $paginatedCategories->links() }}
            </div>
        </div>
    </div>

</div>
