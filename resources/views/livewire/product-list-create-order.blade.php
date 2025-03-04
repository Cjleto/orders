<div class="container-fluid">

    <nav class="navbar navbar-light text-secondary">
            <span class="mb-0 navbar-brand fs-3 d-flex align-items-center">
                <x-common.product-icon class="me-2 text-primary " /> {{ __('products') }}
            </span>
    </nav>

    <div class="col-12">
        <div class="card card-secondary">

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
                            <th scope="col">{{ __('Disponibilità') }}</th>
                            <th scope="col">{{ __('Carrello') }}</th>
                            <th scope="col">{{ __('Azioni') }}</th>
                        </tr>
                    </thead>
                    <tbody >
                        @forelse ($products as $product)
                            <tr wire:key="product-{{ $product->id }}">

                                <td>
                                    <div class="fw-bold">{{ $product->id }} - {{ $product->name }}</div>
                                </td>

                                <td>
                                    <span class="text-muted fs-6">{{ $product->description }}</span>
                                </td>

                                <td>{{ $product->formatted_price }}</td>

                                <td>{{ $product->is_in_stock }}</td>

                                <td>
                                    {{ $this->orderItemQuantity($product) }}
                                </td>

                                <td>
                                    <div class="gap-2 d-flex align-items-center justify-content-start" wire:ignore.self>

                                        <div class="btn btn-primary btn-sm"
                                            wire:click="addProduct({{ $product }})">
                                            <svg class="icon">
                                                <use xlink:href="{{ asset('icons/coreui.svg#cil-plus') }}"></use>
                                            </svg>
                                        </div>

                                        <div class="btn btn-danger btn-sm"
                                            wire:click="removeProduct({{ $product }})">
                                            <svg class="icon">
                                                <use xlink:href="{{ asset('icons/coreui.svg#cil-minus') }}"></use>
                                            </svg>
                                        </div>

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
            </div>
        </div>
    </div>

</div>
