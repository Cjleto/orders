<div>
    <div class="gap-3 d-flex justify-content-between">
        {{-- <div class="flex-column">
            <div>{{ $this->dishItem->name }}</div>
            <div class="text-muted small">€{{ number_format($this->dishItem->price, 2) }}</div>
        </div>
        <div class="flex-row d-flex justify-content-between">
            @foreach ($this->dishItem->allergens as $allergen)
                <div class="p-1 badge badge-allergens d-flex align-items-center justify-content-center"
                    id="allergen-{{ $this->dishItem->id }}-{{ $allergen->id }}"
                    state="{{ $this->dishItem->allergens->contains($allergen) ? 'active' : 'inactive' }}"
                    data-coreui-toggle="tooltip" data-coreui-placement="top" data-coreui-custom-class="custom-tooltip"
                    data-coreui-title="{{ $allergen->description }}"
                    wire:key="allergen-{{ $this->dishItem->id }}-{{ $allergen->id }}"
                    >
                    <i class="fa-solid fa-{{ $allergen->icon }}"></i>
                </div>
            @endforeach
        </div> --}}

        <div class="flex-column">
            <div>
                <a href="{{ route('category.dishes.index',
                    [
                        'category' => $this->dishItem->category->id,
                        'search' => $this->dishItem->id
                    ]) }}"
                    class="p-1 border-1 border-secondary rounded-2 me-2 text-decoration-none fs-5">
                    {{ $this->dishItem->name }}
                </a>
            </div>
            <div class="flex-row d-flex">
                @foreach ($this->dishItem->allergens as $allergen)
                    <div class="badge badge-allergens-small d-flex align-items-center justify-content-center"
                        id="allergen-{{ $this->dishItem->id }}-{{ $allergen->id }}"
                        state="active"
                        data-coreui-toggle="tooltip" data-coreui-placement="bottom"
                        data-coreui-custom-class="custom-tooltip" data-coreui-title="{{ $allergen->description }}">
                        <i class="fa-solid fa-{{ $allergen->icon }}"></i>
                    </div>
                @endforeach
                @foreach ($this->dishItem->peculiarities as $peculiarity)
                    <div class="badge badge-peculiarities-small d-flex align-items-center justify-content-center"
                        id="peculiarity-{{ $this->dishItem->id }}-{{ $peculiarity->id }}"
                        state="active"
                        data-coreui-toggle="tooltip" data-coreui-placement="bottom"
                        data-coreui-custom-class="custom-tooltip" data-coreui-title="{{ $peculiarity->description }}">
                        <i class="fa-solid fa-{{ $peculiarity->icon }}"></i>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="flex-column d-flex justify-content-end align-items-center ">
            <div class="align-self-end">€{{ number_format($this->dishItem->price, 2) }}</div>
            {{-- <div class="flex-row gap-1 d-flex">
                @foreach ($this->dishItem->partialPrices as $partialPrice)
                    <div class="badge bg-indigo">
                        <div class="">{{ $partialPrice->label }}</div>
                        <div class="">€{{ number_format($partialPrice->price, 2) }}</div>
                    </div>
                @endforeach
            </div> --}}
            @if (!empty($this->partialPricesTitle))
                <div class="flex-row gap-1 d-flex">
                    <div class="badge bg-info" data-coreui-toggle="tooltip"
                        data-coreui-placement="bottom"
                        data-coreui-custom-class="custom-tooltip"
                        data-coreui-html="true"
                        data-coreui-title="{!! $this->partialPricesTitle !!}">
                        <x-common.partial-prices-icon />
                    </div>
                </div>
            @endif

        </div>


    </div>
</div>
