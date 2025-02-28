<div class="container-fluid">

    <x-common.category-breadcrumb :category="$category" :sub_category="$sub_category" :dishes="true" />

    <nav class="navbar navbar-light text-secondary">
        <div class="container-fluid d-flex justify-content-between">
            <div class="gap-2 d-flex justify-content-start align-items-center">
                <div class="fs-3"><i class="fas fa-list me-2"></i>{{ $sub_category?->name ?? $category?->name }}</div>
                <livewire:togglevisible :model="$category" :wire:key="$category->name">
            </div>
            <div class=" d-flex justify-content-end">
                <span
                    class="p-0 me-2 text-end text-muted text-secondary fs-6 d-none d-md-inline">{{ $category->description }}</span>
                <livewire:helpinfo.dish-index />
            </div>
        </div>
    </nav>

    <div class="col-12">
        <div class="card card-secondary">
            <div class="card-header d-flex justify-content-between">
                <div class="d-flex justify-content-start align-items-center">
                    <label class="form-label text-nowrap align-items-center">Per page:</label>
                    <select wire:model.live='paginationCount' class="form-select-sm ms-1">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>

                <div class="gap-2 d-flex justify-content-end align-items-center">
                    <div>
                        <input type="text" class="form-control" placeholder="{{ __('Search') }}"
                            wire:model.live.debounce.300ms="search">
                    </div>
                    <div>

                        <a class="btn btn-sm btn-primary"
                            href="{{ route('dishes.create', [
                                'user' => $category->macroCategory->company->user,
                                'selected_macro_id' => $category->macroCategory->id,
                                'selected_category_id' => $category->id,
                                'selected_sub_category_id' => $sub_category?->id,
                            ]) }}"
                            data-coreui-toggle="tooltip" data-coreui-placement="top"
                            data-coreui-custom-class="custom-tooltip" data-coreui-title="{{ __('Add') }}">
                            <svg class="icon">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-plus') }}"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div wire:loading>
                <div class="p-3 m-4 alert alert-primary">
                    <div class="d-flex align-items-center justify-content-center">
                        <div><strong>Loading...</strong></div>
                        <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
                    </div>
                </div>
            </div>

            <div class="card-body" style="overflow-x: auto;" wire:loading.remove>

                <table class="table mt-2 table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('Name') }}</th>
                            <th scope="col">{{ __('Foto') }}</th>
                            <th scope="col">{{ __('Descrizione') }}</th>
                            <th scope="col">{{ __('Prezzo') }}</th>
                            <th scope="col">{{ __('Azioni') }}</th>
                        </tr>
                    </thead>
                    <tbody wire:sortable="updateDishOrder">
                        @forelse ($paginatedDishes as $dish)
                            <tr wire:sortable.item="{{ $dish->id }}" wire:key="dish-{{ $dish->id }}">
                                <td wire:sortable.handle role="button">
                                    <i class="fa-solid fa-sort"></i>
                                </td>

                                <td>
                                    <div class="fw-bold">{{ $dish->id }} - {{ $dish->name }}</div>
                                    @if ($dish->subCategory)
                                        <span class="badge bg-teal">{{ $dish->subCategory->name }}</span>
                                    @endif
                                </td>

                                <td>
                                    @if ($dish->photo)
                                        <img src="{{ $dish->getFirstMediaUrl('photo', 'squared') }}"
                                            alt="{{ $dish->name }}" class="img-thumbnail" />
                                    @else
                                        <div class="p-1 badge bg-warning">{{ __('No photo') }}</div>
                                    @endif

                                </td>

                                <td>
                                    <span class="text-muted fs-6">{{ $dish->description }}</span>
                                </td>

                                <td>{{ $dish->price }}</td>

                                <td>
                                    <div class="gap-2 d-flex align-items-center justify-content-start" wire:ignore.self>

                                        @livewire(
                                            'dish-edit',
                                            [
                                                'dish' => $dish,
                                            ],
                                            key('dish-form-' . $dish->id)
                                        )

                                        <livewire:allergens_assign :dish="$dish"
                                            :wire:key="'allergensassign-'.$dish->id" />
                                        <livewire:partial_price_assign :dish="$dish"
                                            :wire:key="'partialpriceassign-'.$dish->id" />
                                        <livewire:togglevisible :model="$dish"
                                            :wire:key="'togglevisibile-'.$dish->id" />
                                        @if (config('myconst.translate_enabled'))

                                            <livewire:translation-show-list :model="$dish"
                                            :wire:key="'translations-component-'.$dish->id"  />
                                            {{-- <a class="btn btn-sm btn-warning"
                                                href="{{ route('model.translations.index', ['model' => get_class($dish), 'model_id' => $dish->id]) }}"
                                                data-coreui-toggle="tooltip" data-coreui-placement="top"
                                                data-coreui-custom-class="custom-tooltip" data-coreui-title="{{ __('Translate') }}">
                                                <svg class="icon">
                                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-translate') }}"></use>
                                                </svg>
                                            </a> --}}

                                        @endif
                                        <livewire:dish-delete :dish="$dish" :wire:key="'dishdelete-'.$dish->id" />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    <x-common.badge-no-results>Nessuna sub category
                                        configurata</x-common.badge-no-results>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $paginatedDishes->links() }}
            </div>
        </div>
    </div>

</div>
