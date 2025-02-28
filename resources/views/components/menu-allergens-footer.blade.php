@props(['classContainer' => '', 'classBtn' => ''])

<div {{ $attributes->merge(['class' => ' ' . $classContainer]) }}>
    <style>
        /* Stile base per bottoni circolari */
        .btn-allergen {
            width: 50px;
            /* Imposta una larghezza fissa */
            height: 50px;
            /* Imposta un'altezza fissa per renderlo circolare */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.5rem;
        }
    </style>


    <a {{ $attributes->merge(['class' => 'btn btn-secondary ms-2 ' . $classBtn]) }} data-coreui-toggle="offcanvas" href="#offcanvasExample" role="button"
        aria-controls="offcanvasExample">
        <i class="fa-solid fa-info-circle"></i>
        {{ __('Allergens') }}
    </a>
    {{-- <button class="btn btn-primary" type="button" data-coreui-toggle="offcanvas" data-coreui-target="#offcanvasExample" aria-controls="offcanvasExample">
        Button with data-coreui-target
      </button> --}}



    <div class="mb-5 offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasExample"
        aria-labelledby="offcanvasMenuAllergensLabel" style="height: 80%">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasMenuAllergensLabel">{{ __('Allergens') }}</h5>
            <button type="button" class="btn-close text-reset" data-coreui-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="alert bg-light">
                <i class="fa-solid fa-exclamation-circle text-warning"></i>
                {{ __('footer_allergens_text') }}
            </div>

            <div class="alert alert-info" style="font-size: 0.8em">
                {!! __('allergens.footer_msg') !!}
            </div>

            <div class="p-2">
                @foreach ($allergens as $index => $allergen)
                    <div class="gap-2 mt-2 d-flex justify-content-start align-items-center">
                        <div class="btn-allergen" style="background-color: var(--color-allergen-{{ $index }});">
                            <i class="fa-solid fa-{{ $allergen->icon }} fs-3 text-white"></i>
                        </div>
                        <div class="d-flex justify-content-between flex-column">
                            <div class="">{{ __("allergens.{$allergen->name}.name") }}</div>
                            <div class="text-muted">{{ __("allergens.{$allergen->name}.description") }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
