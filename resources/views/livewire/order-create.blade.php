<div class="container">
    <div class="d-flex justify-content-between">
        <div>
            <h2>Crea Ordine</h2>
        </div>

        <div>

            <button class="btn btn-primary position-relative" type="button" data-coreui-toggle="offcanvas"
                data-coreui-target="#offcanvasRight" aria-controls="offcanvasRight">
                <i class="fa-solid fa-bag-shopping"></i>
                <span class="top-0 position-absolute start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $this->total }} {{ config('myconst.currency_symbol') }}
                    <span class="visually-hidden"></span>
                </span>
            </button>


            <div class="offcanvas offcanvas-end cj-custom-offcanvas-width" tabindex="-1" id="offcanvasRight"
                aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasRightLabel">{{ __('cart') }}</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="list-group">
                        @forelse($orderItems as $item)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-between">
                                        <div class="d-flex flex-column">
                                            <div class="text-primary fw-bolder">{{ $item['product_name'] }}</div>
                                            <div>qta: {{ $item['quantity'] }}</div>
                                        </div>
                                        <div>
                                            <div>{{ $item['product_price'] }}</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <div class="text-white btn btn-warning">{{ __('No products in the cart') }}</div>
                        @endforelse
                    </ul>

                </div>
            </div>
        </div>


    </div>


    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-4">
                <label for="customer" class="form-label">Cliente</label>
                <select class="form-select" id="customer" wire:model.live="customer_id">
                    <option value="0" disabled>Seleziona Cliente</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->full_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-4">
                <label for="product" class="form-label">Prodotto</label>
                <input type="text" class="form-control" placeholder="Cerca Prodotto"
                    wire:model.live.debounce.300ms="searchProduct">
                </select>
            </div>
        </div>
    </div>

    @if ($customer_id > 0)
        @livewire(
            'product-list-create-order',
            [
                'searchString' => $searchProduct,
                'orderItems' => $orderItems,
            ],
            key('product-list-create-order')
        )
    @endif


    @if ($selectedProductId)
        <div class="mb-4 overflow-hidden border-0 shadow-sm card"
            style="transition: transform 0.2s; border-radius: 10px;">
            <!-- Header -->
            <div class="text-white card-header bg-primary d-flex justify-content-between align-items-center">
                <span>Dettagli Prodotto</span>
                <!-- Badge per lo stato dello stock -->
                <span class="badge {{ $selectedProduct->is_in_stock > 0 ? 'bg-success' : 'bg-danger' }}">
                    {{ $selectedProduct->stock > 0 ? 'Disponibile' : 'Esaurito' }}
                </span>
            </div>

            <!-- Corpo della card -->
            <div class="card-body d-flex align-items-center">
                <!-- Immagine del prodotto -->
                <div class="photo-container me-3">
                    <a href="{{ $product->getFirstMediaUrl('photo') }}" data-lightbox="img-{{ $product->id }}">
                        <img src="{{ $product->getFirstMediaUrl('photo', 'thumb') }}" alt="{{ $product->name }}"
                            class="rounded shadow-sm img-fluid img-thumbnail"
                            style="width: 150px; height: 150px; object-fit: cover;">
                    </a>
                </div>

                <!-- Dettagli prodotto -->
                <div>
                    <h5 class="card-title fw-bold text-primary">{{ $selectedProduct->name }}</h5>
                    <p class="card-text text-success fs-5 fw-semibold">{{ $selectedProduct->formatted_price }}</p>
                    <p class="card-text text-muted">{{ $selectedProduct->description }}</p>
                </div>
            </div>
        </div>
    @endif




    @if ($showSaveButton)
        <div class="mt-4">
            <button type="button" class="text-white btn btn-success" wire:click="saveOrder">{{ __('create') }}
                {{ __('order') }}</button>
        </div>
    @endif
</div>
