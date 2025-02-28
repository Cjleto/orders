<div>
    <!-- Button trigger modal -->
    <button type="button" class="text-white btn btn-sm bg-indigo position-relative" data-coreui-toggle="modal" data-coreui-target="#partialPriceModal{{ $dish->id }}">
        <x-common.partial-prices-icon />
        <span class="top-0 position-absolute start-100 translate-middle badge rounded-pill bg-danger">
            {{ $dish->partialPrices->count() }}
            <span class="visually-hidden">{{ __('Partial Prices') }}</span>
          </span>
    </button>

    <!-- Modal -->
    <div wire:ignore.self class="modal modal-xl fade" id="partialPriceModal{{ $dish->id }}" tabindex="-1" aria-labelledby="partialPriceModal{{ $dish->id }}Label"
        aria-hidden="true" data-coreui-backdrop="static" data-coreui-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="partialPriceModal{{ $dish->id }}Label">{{ $dish->name }}: {{ __('Select Prices') }}</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>{{ __('Partial Prices') }}</div>
                                <div>
                                    <div class="p-1 alert alert-info">
                                        {{ __('Unit Price') }} {{ $dish->price }}
                                    </div>
                                </div>
                            </div>
                            <p class="openSans fst-italic" style="color: #8b8b8b; font-size:15px;">
                                {{ __('assign_partial_price_title') }}
                            </p>
                            <div class="" id="containerPartialPrices">

                                @foreach ($partial_prices as $index => $partial_price)
                                    <div class="mt-3 row callout callout-primary">
                                        <div class="col-12 col-md-7">
                                            <div class="form-group @if ($errors->has('partial_prices.' . $index . '.label')) has-error @endif">
                                                <label for="partial_prices[{{ $dish->id }}][{{ $index }}][label]">{{ __('Label') }} *</label>
                                                <input wire:model.defer="partial_prices.{{ $index }}.label"
                                                    type="text"
                                                    class="form-control"
                                                    id="partial_prices[{{ $dish->id }}][{{ $index }}][label]"
                                                    autocomplete="off"
                                                    placeholder="{{ __('Enter label') }}"
                                                    value="{{ $partial_price['label'] }}" />
                                                @error('partial_prices.' . $index . '.label')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group @if ($errors->has('partial_prices.' . $index . '.price')) has-error @endif">
                                                <label for="partial_prices[{{ $dish->id }}][{{ $index }}][price]">{{ __('Price') }} *</label>
                                                <input wire:model.defer="partial_prices.{{ $index }}.price" type="number" class="form-control" id="partial_prices[{{ $dish->id }}][{{ $index }}][price]"
                                                    autocomplete="off" placeholder="{{ __('Enter price') }}" value="{{ $partial_price['price'] }}" />
                                                @error('partial_prices.' . $index . '.price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <span  class="">Remove</span>
                                            <button type="button" class="btn btn-danger btn-sm" wire:click="removePartialPrice({{ $index }})">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <div class="p-1 text-center alert alert-warning fw-bolder w-100" wire:dirty wire:target="partial_prices">{{ __('Unsaved changes') }}...</div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click='save'>Save changes</button>
                </div>
            </div>
        </div>
    </div>

</div>
