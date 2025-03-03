<div class="container-fluid">

    <nav class="navbar navbar-light text-secondary">
            <span class="mb-0 navbar-brand fs-3 d-flex align-items-center">
                <x-common.product-icon class="me-2 text-primary " /> {{ __('products') }}
            </span>
    </nav>

    <div class="col-12">
        <div class="card card-secondary">
            <div class="card-header d-flex justify-content-between">
                <div class="d-flex justify-content-start align-items-center">
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
                            href="{{ route('products.create') }}"
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
                            <th scope="col">{{ __('Name') }}</th>
                            <th scope="col">{{ __('Descrizione') }}</th>
                            <th scope="col">{{ __('Prezzo') }}</th>
                            <th scope="col">{{ __('Azioni') }}</th>
                        </tr>
                    </thead>
                    <tbody >
                        @forelse ($paginatedProducts as $product)
                            <tr wire:key="product-{{ $product->id }}">

                                <td>
                                    <div class="fw-bold">{{ $product->id }} - {{ $product->name }}</div>
                                </td>

                                <td>
                                    <span class="text-muted fs-6">{{ $product->description }}</span>
                                </td>

                                <td>{{ $product->formatted_price }}</td>

                                <td>
                                    <div class="gap-2 d-flex align-items-center justify-content-start" wire:ignore.self>
                                        <a href="{{ route('products.show', $product) }}"
                                            class="btn btn-sm btn-primary"
                                            data-coreui-toggle="tooltip" data-coreui-placement="top"
                                            data-coreui-custom-class="custom-tooltip" data-coreui-title="{{ __('Show') }}">
                                            <svg class="icon">
                                                <use xlink:href="{{ asset('icons/coreui.svg#cil-magnifying-glass') }}"></use>
                                            </svg>
                                        </a>
                                        @livewire(
                                            'product-edit',
                                            [
                                                'product' => $product,
                                            ],
                                            key('product-form-' . $product->id)
                                        )
                                        @livewire(
                                            'product-delete',
                                            [
                                                'product' => $product,
                                            ],
                                            key('product-delete-' . $product->id)
                                        )

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    <x-common.badge-no-results>{{ __('no_products_found') }}</x-common.badge-no-results>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $paginatedProducts->links() }}
            </div>
        </div>
    </div>

</div>
