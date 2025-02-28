<div>

    <x-common.category-breadcrumb :category="$category" />

    <nav class="navbar navbar-light text-secondary">
        <div class="container-fluid d-flex justify-content-between">
            <div class="gap-2 d-flex justify-content-start align-items-center">
                <div class="fs-3 "><i class="fas fa-list me-2"></i>{{ $category->name }}</div>
                {{-- <x-visible-button :visibility="$category->is_visible" class="ms-2" /> --}}
                <livewire:togglevisible :model="$category" :wire:key="$category->name">
            </div>
            <div class="">
                <livewire:helpinfo.general-crud :type="'sub-category'" />
            </div>
        </div>
    </nav>

    <div class="col-12">
        <div class="card card-secondary">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>{{ __('Sub Categories') }}</div>
                <livewire:sub_category_create :category="$category">
            </div>
            <div class="card-body">
                <ol class="m t-2 list-group list-group-flush" wire:sortable="updateSubCategoryOrder">
                    @forelse ($paginatedSubCategories as $sub_category)
                        <li class="list-group-item d-flex justify-content-between align-items-start"
                            wire:sortable.item="{{ $sub_category->id }}"
                            wire:key="sub_category-{{ $sub_category->id }}">
                            <div class="ms-2 me-auto d-flex justify-content-start">
                                <div class="me-2" wire:sortable.handle role="button">
                                    <i class="fa-solid fa-sort"></i>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="fw-bold">{{ $sub_category->name }} </div>
                                    <span class="text-muted fs-6">{{ $sub_category->description }}</span>

                                    <x-common.badge-dishes :subCategory="$sub_category" :dishes_count="$sub_category->dishes_count" />
                                </div>
                            </div>
                            <div class="gap-2 d-flex">


                                <a href="{{ route('sub_categories.edit', $sub_category) }}"
                                    class="btn btn-sm btn-warning" data-coreui-toggle="tooltip"
                                    data-coreui-placement="top" data-coreui-custom-class="custom-tooltip"
                                    data-coreui-title="{{ __('Edit') }}">
                                    <svg class="icon">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-pencil') }}"></use>
                                    </svg>
                                </a>
                                <livewire:translation-show-list :model="$sub_category"
                                    :wire:key="'translations-component-'.$sub_category->id"  />
                                <livewire:togglevisible :model="$sub_category" :wire:key="$sub_category->id">
                                <livewire:sub-category-delete :subCategory="$sub_category" :wire:key="'delete-'.$sub_category->id">
                            </div>
                        </li>
                    @empty
                        <div class="d-flex align-self-center">
                            <x-common.badge-no-results>Nessuna sub category
                                configurata</x-common.badge-no-results>
                        </div>
                    @endforelse
                </ol>
                {{ $paginatedSubCategories->links() }}
            </div>
        </div>
    </div>

</div>
