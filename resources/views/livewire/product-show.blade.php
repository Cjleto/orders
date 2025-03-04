<div class="container mt-5">
    <div class="shadow-lg card rounded-4">
        <div class="text-center card-body">
            <!-- Foto del Prodotto con Lightbox -->
            <div class="mb-4">
                @if ($product->photo)

                    <div class="photo-container me-3">
                        <a href="{{ $product->getFirstMediaUrl('photo') }}"
                            data-lightbox="img-{{ $product->id }}">
                            <img src="{{ $product->getFirstMediaUrl('photo', 'thumb') }}"
                                alt="{{ $product->name }}"
                                class="img-fluid img-thumbnail ">
                        </a>
                    </div>
                @else
                    <div class="p-2 badge bg-warning">{{ __('No photo') }}</div>
                @endif
            </div>

            <!-- Nome prodotto -->
            <h3 class="fw-bold text-primary">{{ $product->name }}</h3>
            <p class="text-muted">{{ $product->description }}</p>

            <!-- Tabella dettagli prodotto -->
            <div class="table-responsive">
                <table class="table align-middle table-striped">
                    <tbody>
                        <tr>
                            <th class="w-25 text-end">{{ __('Price') }}</th>
                            <td class="fw-bold text-success">{{ $product->formatted_price }}</td>
                        </tr>
                        <tr>
                            <th class="text-end">{{ __('Stock') }}</th>
                            <td>
                                <div class="d-flex align-items-center justify-content-around">
                                    <span class="badge fs-6 px-3 py-2 {{ $product->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $product->isInStock ? trans('Available') : trans('Out of Stock') }}
                                        <div class="badge bg-light text-dark rounded-1">{{ $product->stock }}</div>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-end">{{ __('Created At') }}</th>
                            <td>{{ $product->created_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pulsante Indietro -->
            <div class="mt-4">
                <a href="{{ route('products.index') }}" class="px-4 btn btn-outline-primary rounded-pill">
                    <i class="bi bi-arrow-left"></i> {{ __('Indietro') }}
                </a>
            </div>
        </div>
    </div>
</div>


