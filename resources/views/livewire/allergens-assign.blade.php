<div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-sm btn-primary" data-coreui-toggle="modal" data-coreui-target="#allergensModal{{ $dish->id }}">
        <x-common.allergens-icon />
    </button>

    <!-- Modal -->
    <div wire:ignore.self class="modal modal-xl fade" id="allergensModal{{ $dish->id }}" tabindex="-1" aria-labelledby="allergensModal{{ $dish->id }}Label"
        aria-hidden="true" data-coreui-backdrop="static" data-coreui-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="allergensModal{{ $dish->id }}Label">{{ $dish->name }}: {{ __('Select allergenes') }}</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="callout callout-primary">
                            {{ __('Allergenes') }}
                            <p class="openSans fst-italic" style="color: #8b8b8b; font-size:15px;">
                                {{ __('assign_allergens_title') }}
                            </p>
                            <div class="flex-wrap d-flex justify-content-start" id="containerAllergeni">

                                @foreach ($availableAllergens as $index => $allergen)
                                    <div
                                        class="btn btn-allergens d-flex align-items-center justify-content-center"
                                        id="allergen-{{ $dish->id }}-{{ $allergen->id }}"
                                        state="{{ $dish->allergens->contains($allergen) ? 'active' : 'inactive' }}"
                                        data-coreui-toggle="tooltip" data-coreui-placement="top"
                                        data-coreui-custom-class="custom-tooltip"
                                        data-coreui-title="{{ $allergen->description }}"
                                        wire:key="allergen-{{ $dish->id }}-{{ $allergen->id }}"
                                        wire:click="toggleAllergen({{ $allergen->id }})">
                                        <i class="fa-solid fa-{{ $allergen->icon }} fs-3"></i>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="callout callout-warning">
                            {{ __('Peculiarities') }}

                            <p class="openSans fst-italic" style="color: #8b8b8b; font-size:15px;">
                                Seleziona le caratteristiche del piatto
                            </p>
                            <div class="flex-wrap d-flex justify-content-start" id="containerPeculiarities">

                                @foreach ($availablePeculiarities as $index => $peculiarity)
                                    <div
                                        class="btn btn-allergens d-flex align-items-center justify-content-center"
                                        id="peculiarity-{{ $dish->id }}-{{ $peculiarity->id }}"
                                        state="{{ $dish->peculiarities->contains($peculiarity) ? 'active' : 'inactive' }}"
                                        data-coreui-toggle="tooltip" data-coreui-placement="top"
                                        data-coreui-custom-class="custom-tooltip"
                                        data-coreui-title="{{ $peculiarity->description }}"
                                        wire:key="peculiarity-{{ $dish->id }}-{{ $peculiarity->id }}"
                                        wire:click="togglePeculiarity({{ $peculiarity->id }})">
                                        <i class="fa-solid fa-{{ $peculiarity->icon }} fs-3"></i>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>

</div>
