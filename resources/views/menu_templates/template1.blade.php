<div x-data="{
    selectedCategory: '{{ $menuMap->count() > 0 ? Str::slug($menuMap[0]['name']) : null }}',
    font: '{{ $selectedFont }}',
    fontSecondary: '{{ $selectedSecondaryFont }}',
}" @font-changed.window="font = $event.detail; console.log('Font received to:', font)"
    @secondary-font-changed.window="fontSecondary = $event.detail; console.log('Secondary Font received to:', fontSecondary)"
    class="menu-container" :style="'font-family: ' + font" style="">
    <!-- Stile e script Alpine.js -->
    <style>
        .menu-container {
            border-radius: 0 !important;
            overflow: hidden;
        }

        @media (max-width: 768px) {
            .menu-container {
                position: unset;
                padding: 0px;
            }
        }

        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-size: revert;
            background-attachment: fixed;
            background-repeat: initial;
            background-position: center;
            transition: opacity 0.3s ease;
        }

        .content {
            position: relative;
            z-index: 1;
            padding: 20px;
            //background-color: rgba(255, 255, 255, 0.8);
            border-radius: 5px;
        }

        .dish-card {
            margin-bottom: 20px;
            background-color: #f8f9fa;
        }

        .category-selector {
            z-index: 1050;
            border-top: 1px solid #ddd;
            position: fixed;
            /* Change to fixed */
            bottom: 0;
            /* Stick to the bottom of the viewport */
            width: -webkit-fill-available;
            /* Ensure it spans the full width */
            background-color: #f8f9fa;
            padding: 10px;
            border-top: 1px solid #ddd;
            /* left: 18%;
            right: 18%; */
            left: 0;
        }

        .category-selector button {
            flex-grow: 1;
            margin: 0 5px;
        }

        /* Custom Styles for h1, h2, h3 with Livewire variables */
        h1,
        h2,
        h3 {
            color: {{ $this->menuSetting->secondary_color }};
        }

        .nav-tabs .nav-link {
            color: {{ $this->menuSetting->primary_color }};
        }

        .nav-tabs .nav-link.active {
            background-color: {{ $this->menuSetting->primary_color }};
            color: white;
        }

        .chosen_primary_color {
            color: {{ $this->menuSetting->primary_color }} !important;
        }

        .bg_chosen_primary_color {
            background-color: {{ $this->menuSetting->primary_color }} !important;
        }


        .chosen_secondary_color {
            color: {{ $this->menuSetting->secondary_color }} !important;
        }

        .bg_chosen_secondary_color {
            background-color: {{ $this->menuSetting->secondary_color }} !important;
        }

        /* For scrolling page */
        body {
            overflow-y: auto;
        }

        .dots {
            flex-grow: 1;
            /* Permette al div di espandersi per riempire lo spazio */
            height: 1px;
            /* Altezza della linea di punti */
            border-top: 2px dotted #d1d1d1;
            /* Crea una linea di punti */
            margin: 0 50px;
            /* Margine laterale per distanziare dai div laterali */
        }

        @media (max-width: 752px) {

            /* Adatta il valore secondo le tue necessità */
            .dots {
                display: none;
                /* Nasconde i punti su schermi piccoli */
            }
        }

        .img-dish-menu {
            max-width: 100px;
            border-radius: 10%;
            /* box-shadow: 4px 4px 7px gray; */
        }


        .description {
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            color: {{ $this->menuSetting->tertiary_color }};
        }

        /* Contenitore per l'immagine, mantiene la larghezza fissa e resta accanto alla descrizione */
        .photo-container {
            flex: 0 0 100px;
            /* Imposta una larghezza fissa per l'immagine */
        }

        /* Garantisci che il prezzo sia accanto al nome del piatto */
        .price-container {
            flex-shrink: 0;
            /* Impedisce al prezzo di ridursi */
            margin-left: auto;
            /* Spinge il prezzo a destra */
        }

        .force-public-styles {
            position: fixed;
            background-size: auto;
            background-repeat: repeat;
            z-index: -1;
        }
        .dish_name {
            font-size: 1.2rem;
            color: {{ $this->menuSetting->quaternary_color }};
        }
    </style>
    <!-- Contenuto del menu -->
    <div class="content">
        <div class="d-flex justify-content-between">
            @if ($this->logo)
                <div>
                    <img src="{{ $this->logo }}" alt="{{ $company['name'] }}" class="img-fluid"
                        style="max-height: 50px;">
                </div>
            @endif
            {{-- <div x-data="{ title: '{{ $this->menuSetting()->title }}' }" @title-changed.window="title = $event.detail" id="highlight-target">
                    <h1 class="text-center " x-text="title"></h1>
                </div> --}}
            @if ($this->enableLanguageSwitcher)
                <div style="">
                    <livewire:language-switcher :company_id="$company['id']" />
                </div>
            @endif
        </div>
    </div>

    <!-- Tab per visualizzare ogni macrocategoria -->
    @foreach ($menuMap as $record)

        <div x-show="selectedCategory === '{{ Str::slug($record['macro_obj']->name) }}'">
            <h2 class="text-center chosen_primary_color ms-2" :style="{ 'font-family': fontSecondary }">
                {{ $record['macro_obj']->getTranslatedValue('name') }}
            </h2>
            @foreach ($record['categories'] as $category)
                <h3 class="chosen_secondary_color ms-2" :style="{ 'font-family': fontSecondary }">
                    {{ $category['category_obj']->getTranslatedValue('name') }}
                </h3>
                @foreach ($category['sub_categories'] as $sub_category)
                    <div class="card dish-card">
                        <div class="card-body">
                            <div class="mb-1 text-center fs-3 chosen_primary_color"
                                :style="{ 'font-family': fontSecondary }">
                                {{ $sub_category['sub_category_obj']->getTranslatedValue('name') }}
                            </div>
                            @foreach ($sub_category['dishes'] as $dish)
                                <div class="d-flex border-bottom border-bottom-1 align-items-start mt-md-0">
                                    @if ($dish->hasMedia('photo'))
                                        <div class="photo-container me-3">
                                            <a href="{{ $dish->getFirstMediaUrl('photo') }}"
                                                data-lightbox="img-{{ $dish->id }}">
                                                <img src="{{ $dish->getFirstMediaUrl('photo', 'thumb') }}"
                                                    alt="{{ $dish->translated_name }}"
                                                    class="img-fluid img-thumbnail img-dish-menu">
                                            </a>
                                        </div>
                                    @endif
                                    <div class="d-flex flex-column flex-grow-1 w-100">
                                        <div class="d-flex justify-content-between w-100">
                                            <div class="dish_name fs-4">
                                                {{ $dish->translated_name }}</div>
                                            <!-- Spostato il prezzo qui in modo che sia visibile sempre -->
                                            <div class="align-self-center price-container d-flex">
                                                <span class="chosen_primary_color fs-5 text-nowrap">
                                                    {{ $dish['price'] }}
                                                    @if ($dish->partialPrices()->count() > 0)
                                                        <span class="p-0 badge chosen_secondary_color fs-6"
                                                            data-coreui-toggle="tooltip" data-coreui-html="true"
                                                            data-coreui-placement="bottom"
                                                            title="
                                                                        @foreach ($dish->partialPrices as $partialPrice)
                                                                            @if (!$loop->first)
                                                                                <br>
                                                                            @endif
                                                                            {{ $partialPrice->label }}: {{ $partialPrice->price }} @endforeach
                                                                    ">
                                                            <i class="fa-solid fa-info-circle"></i>
                                                        </span>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        {{-- <div
                                        class="badge bg_chosen_primary_color rounded-pill d-md-none w-25">
                                        {{ $dish['price'] }}
                                    </div> --}}
                                        <!-- Aggiungi una classe per limitare la larghezza della descrizione -->
                                        <div class="mt-0 description">
                                            {{ $dish->getTranslatedValue('description') }}</div>
                                        <div class="gap-1 d-flex justify-content-start">
                                            @foreach ($dish->allergens()->get() as $allergen)
                                                <div class="badge badge-allergens-small d-flex align-items-center justify-content-center"
                                                    state="active" data-coreui-toggle="tooltip"
                                                    data-coreui-placement="bottom"
                                                    data-coreui-custom-class="custom-tooltip"
                                                    data-coreui-title="{{ $allergen->description }}">
                                                    <i class="fa-solid fa-{{ $allergen->icon }}"></i>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                @foreach ($category['dishes_without_subcategory'] as $dish)
                    <div class="mb-3 border-0 card bg-light">
                        <ul class="list-group list-group-flush">

                            <li class="list-group-item">
                                <div class="d-flex border-bottom border-bottom-1 align-items-start mt-md-0">
                                    @if ($dish->hasMedia('photo'))
                                        <div class="photo-container me-3">
                                            <a href="{{ $dish->getFirstMediaUrl('photo') }}"
                                                data-lightbox="img-{{ $dish->id }}">
                                                <img src="{{ $dish->getFirstMediaUrl('photo', 'thumb') }}"
                                                    alt="{{ $dish->translated_name }}"
                                                    class="img-fluid img-thumbnail img-dish-menu">
                                            </a>
                                        </div>
                                    @endif
                                    <div class="d-flex flex-column flex-grow-1 w-100">
                                        <div class="d-flex justify-content-between w-100">
                                            <div class="dish_name fs-4">
                                                {{ $dish->translated_name }}</div>
                                            <!-- Spostato il prezzo qui in modo che sia visibile sempre -->
                                            <div class="align-self-center price-container d-flex">
                                                <span class="chosen_primary_color fs-5 text-nowrap">
                                                    {{ $dish['price'] }}
                                                    @if ($dish->partialPrices()->count() > 0)
                                                        <span class="p-0 badge chosen_secondary_color fs-6"
                                                            data-coreui-toggle="tooltip" data-coreui-html="true"
                                                            data-coreui-placement="bottom"
                                                            title="
                                                                        @foreach ($dish->partialPrices as $partialPrice)
                                                                            @if (!$loop->first)
                                                                                <br>
                                                                            @endif
                                                                            {{ $partialPrice->label }}: {{ $partialPrice->price }} @endforeach
                                                                    ">
                                                            <i class="fa-solid fa-info-circle"></i>
                                                        </span>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        {{-- <div
                                        class="badge bg_chosen_primary_color rounded-pill d-md-none w-25">
                                        {{ $dish['price'] }}
                                    </div> --}}
                                        <!-- Aggiungi una classe per limitare la larghezza della descrizione -->
                                        <div class="mt-0 description">
                                            {{ $dish->getTranslatedValue('description') }}</div>
                                        <div class="gap-1 d-flex justify-content-start">
                                            @foreach ($dish->allergens()->get() as $allergen)
                                                <div class="badge badge-allergens-small d-flex align-items-center justify-content-center"
                                                    state="active" data-coreui-toggle="tooltip"
                                                    data-coreui-placement="bottom"
                                                    data-coreui-custom-class="custom-tooltip"
                                                    data-coreui-title="{{ $allergen->description }}">
                                                    <i class="fa-solid fa-{{ $allergen->icon }}"></i>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                @endforeach
            @endforeach
            <!-- Barra di selezione delle macrocategorie sticky -->
            <div @class(['category-selector', 'd-none' => $hideStaticCssElements])>
                <div class="container">
                    <div class="d-flex justify-content-around">
                        @foreach ($menuMap as $record)
                            <button class="btn btn-outline-secondary "
                                :class="{ 'bg_chosen_primary_color text-white': selectedCategory === '{{ Str::slug($record['macro_obj']->name) }}' }"
                                @click="selectedCategory = '{{ Str::slug($record["name"]) }}'">
                                {{ $record['macro_obj']->getTranslatedValue('name') }}
                            </button>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    @endforeach
    <livewire:menu-text-footer :menu_setting="$this->menuSetting" :class="'text-start mt-3 mb-3 p-1 chosen_secondary_color'" />
    <div class="d-flex justify-content-center flex-column align-items-center" style="margin-bottom: 5rem">
        <x-menu-allergens-footer classContainer="mb-4" />
        <x-social-footer class="bg_chosen_secondary_color" :socials="$this->socialsLinks" />
        <x-menulight-footer class="p-0 mt-2 text-light-emphasis" />
    </div>





</div>
