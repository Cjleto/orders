<div x-data="{
    selectedCategory: '{{ $menuMap->count() > 0 ? Str::slug($menuMap[0]['name']) : null }}',
    font: '{{ $selectedFont }}',
    fontSecondary: '{{ $selectedSecondaryFont }}',
}" @font-changed.window="font = $event.detail; console.log('Font received to:', font)"
    @secondary-font-changed.window="fontSecondary = $event.detail; console.log('Secondary Font received to:', fontSecondary)"
    class="menu-container" :style="'font-family: ' + font" style="position: relative;">
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

        h1,
        h2,
        h3 {
            color: {{ $this->menuSetting->secondary_color }};
            /* Colore dorato */
        }

        .tab-content {
            background-color: unset;
            color: black;
            border-radius: 5px;
            padding: 0px;
            margin-top: 10px;
            min-height: 65vh;
        }

        .tab-pane .list-group-item {
            background-color: unset;
            border: none;
        }

        .tab-pane .list-group-item h4 {
            margin: 0;
            font-weight: bold;
        }

        .tab-pane .list-group-item p {
            margin: 5px 0;
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



        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-size: cover;
            /* Rende l'immagine di sfondo coprente */
            /* background-position: center; */
            /* Centra l'immagine di sfondo */
            transition: opacity 0.3s ease;
            /* Aggiunge una transizione all'opacità */
            background-attachment: fixed;
            /* Mantiene l'immagine fissa durante lo scroll */
            background-repeat: no-repeat;
            background-position-x: left;
        }



        .nav-tabs .nav-link-menu {
            background-color: transparent;
        }

        .nav-tabs .nav-link-menu.active {
            background-color: #fff;

        }

        .nav-pills .nav-link-menu.active {
            background-color: unset;
            text-decoration: underline;
            /* Rimuove la sottolineatura di default */
            /* border-bottom: 2px solid {{ $this->menuSetting->primary_color }}; */
        }

        .nav-link-menu.active {
            text-decoration: underline !important;
            text-underline-offset: 5px;
        }

        .btn-template3 {
            border: 2px solid {{ $this->menuSetting->primary_color }};
            color: {{ $this->menuSetting->primary_color }};
        }

        .btn-template3:hover {
            background-color: {{ $this->menuSetting->primary_color }};
            color: white;
        }

        .btn-template3.active {
            background-color: {{ $this->menuSetting->primary_color }};
            color: white;
        }

        .img-dish-menu {
            max-width: 100px;
            border-radius: 10%;
            box-shadow: 4px 4px 7px gray;
        }

        /* Imposta una larghezza massima per la descrizione */
        .description {
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            color: {{ $this->menuSetting->tertiary_color }};
        }

        /* Contenitore per l'immagine, mantiene la larghezza fissa e resta accanto alla descrizione */
        .photo-container {
            flex: 0 0 100px;
            margin-bottom: 1em;

        }

        /* Garantisci che il prezzo sia accanto al nome del piatto */
        .price-container {
            flex-shrink: 0;
            /* Impedisce al prezzo di ridursi */
            margin-left: auto;
            /* Spinge il prezzo a destra */
        }

        .btn-template3.active,
        .btn-template3:hover {
            color: {{ $this->menuSetting->background_color }};
        }
        .dish_name {
            font-size: 1.2rem;
            color: {{ $this->menuSetting->quaternary_color }};
        }
    </style>

    <div class="contents ms-1 me-1" style="position: relative;">

        <div x-data="{ title: '{{ $this->menuSetting()->title }}' }" @title-changed.window="title = $event.detail" id="highlight-target">
            <div class="d-flex justify-content-between">
                @if ($this->logo)
                    <img src="{{ $this->logo }}" alt="{{ $company['name'] }}" class="img-fluid"
                        style="max-height: 40px; border-radius: 10%;">
                @endif
                @if ($this->enableLanguageSwitcher)

                        <livewire:language-switcher :company_id="$company['id']" />

                @endif
            </div>

        </div>


        <ul class="gap-3 mb-3 nav d-flex justify-content-center font-bigger " id="myTab" role="tablist"
            :style="{ 'font-family': fontSecondary }">
            @foreach ($menuMap as $record)
                <li class="text-center nav-item flex-grow-1 fs-4">
                    <a class="nav-link nav-link-menu chosen_primary_color {{ $loop->first ? 'active' : '' }}"
                        id="{{ Str::slug($record['name']) }}-tab" data-coreui-toggle="tab"
                        href="#{{ Str::slug($record['name']) }}" role="tab"
                        aria-controls="{{ Str::slug($record['name']) }}"
                        aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                        {{ $record['macro_obj']->getTranslatedValue('name') }}
                    </a>
                </li>
            @endforeach
        </ul>


        <div class="tab-content" id="macroCategoryContent">
            @foreach ($menuMap as $record)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                    id="{{ Str::slug($record['name']) }}" role="tabpanel"
                    aria-labelledby="{{ Str::slug($record['name']) }}-tab">

                    {{-- <h2 class="p-2 chosen_secondary_color">{{ $record['name'] }}</h2> --}}

                    <!-- Tabs per le categorie all'interno della macrocategoria -->
                    <ul class="nav nav-tabs d-flex justify-content-center" :style="{ 'font-family': fontSecondary }"
                        id="categoryTabs{{ Str::slug($record['name']) }}" role="tablist">
                        @foreach ($record['categories'] as $category)
                            <li class="m-2 text-center nav-item">
                                <a class="btn btn-template3 {{ $loop->first ? 'active' : '' }}"
                                    id="{{ Str::slug($category['name']) }}-tab" data-coreui-toggle="tab"
                                    href="#{{ Str::slug($category['name']) }}" role="tab"
                                    aria-controls="{{ Str::slug($category['name']) }}"
                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                    {{ $category['category_obj']->getTranslatedValue('name') }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content" id="categoryContent{{ Str::slug($record['name']) }}">
                        @foreach ($record['categories'] as $category)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                id="{{ Str::slug($category['name']) }}" role="tabpanel"
                                aria-labelledby="{{ Str::slug($category['name']) }}-tab">
                                {{-- <h3>{{ $category['name'] }}</h3> --}}
                                @foreach ($category['sub_categories'] as $sub_category)
                                    <div class="mb-3 border-0 ">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <div class="text-center">
                                                    <h3 class=" chosen_primary_color"
                                                        :style="{ 'font-family': fontSecondary }">
                                                        {{ $sub_category['sub_category_obj']->getTranslatedValue('name') }}
                                                    </h3>
                                                </div>
                                            </li>
                                            @forelse ($sub_category['dishes'] as $dish)
                                                <li class="list-group-item">
                                                    <div
                                                        class="d-flex border-bottom border-bottom-1 align-items-start mt-md-0">
                                                        @if ($dish->hasMedia('photo'))
                                                            <div class="photo-container me-3">
                                                                <a href="{{ $dish->getFirstMediaUrl('photo') }}"
                                                                    data-lightbox="img-{{ $dish->id }}">
                                                                    <img src="{{ $dish->getFirstMediaUrl('photo', 'thumb') }}"
                                                                        alt="{{ $dish->name }}"
                                                                        class="img-fluid img-dish-menu">
                                                                </a>
                                                            </div>
                                                        @endif
                                                        <div class="d-flex flex-column flex-grow-1 w-100">
                                                            <div class="d-flex justify-content-between w-100">
                                                                <div class="dish_name fs-4">
                                                                    {{ $dish->translated_name }}</div>
                                                                <!-- Spostato il prezzo qui in modo che sia visibile sempre -->
                                                                <div class="align-self-center price-container d-flex">
                                                                    <span
                                                                        class="chosen_secondary_color fs-5 text-nowrap">
                                                                        {{ $dish['price'] }}
                                                                        @if ($dish->partialPrices->isNotEmpty())
                                                                            <div class="p-0 badge chosen_secondary_color fs-6"
                                                                                data-coreui-toggle="tooltip"
                                                                                data-coreui-html="true"
                                                                                data-coreui-placement="bottom"
                                                                                title="
                                                                                    @foreach ($dish->partialPrices as $partialPrice)
                                                                                        @if (!$loop->first)
                                                                                            <br>
                                                                                        @endif
                                                                                        {{ $partialPrice->label }}: {{ $partialPrice->price }} @endforeach
                                                                                ">
                                                                                <i class="fa-solid fa-info-circle"></i>
                                                                            </div>
                                                                        @endif
                                                                    </span>
                                                                </div>
                                                            </div>

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
                                                                        <i
                                                                            class="fa-solid fa-{{ $allergen->icon }}"></i>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @empty
                                            @endforelse
                                        </ul>
                                    </div>
                                @endforeach

                                <div class="mb-3 border-0 ">
                                    <ul class="list-group list-group-flush">
                                        @foreach ($category['dishes_without_subcategory'] as $dish)
                                            <li class="list-group-item">
                                                <div
                                                    class="d-flex border-bottom border-bottom-1 align-items-start mt-md-0">
                                                    @if ($dish->hasMedia('photo'))
                                                        <div class="photo-container me-3">
                                                            <a href="{{ $dish->getFirstMediaUrl('photo') }}"
                                                                data-lightbox="img-{{ $dish->id }}">
                                                                <img src="{{ $dish->getFirstMediaUrl('photo', 'thumb') }}"
                                                                    alt="{{ $dish->name }}"
                                                                    class="img-fluid img-dish-menu">
                                                            </a>
                                                        </div>
                                                    @endif
                                                    <div class="d-flex flex-column flex-grow-1 w-100">
                                                        <div class="d-flex justify-content-between w-100">
                                                            <div class="dish_name fs-4">
                                                                {{ $dish->translated_name }}</div>
                                                            <!-- Spostato il prezzo qui in modo che sia visibile sempre -->
                                                            <div class="align-self-center price-container d-flex">
                                                                <span class="chosen_secondary_color fs-5 text-nowrap">
                                                                    {{ $dish['price'] }}
                                                                    @if ($dish->partialPrices->isNotEmpty())
                                                                        <div class="p-0 badge chosen_secondary_color fs-6"
                                                                            data-coreui-toggle="tooltip"
                                                                            data-coreui-html="true"
                                                                            data-coreui-placement="bottom"
                                                                            title="
                                                                    @foreach ($dish->partialPrices as $partialPrice)
                                                                        @if (!$loop->first)
                                                                            <br>
                                                                        @endif
                                                                        {{ $partialPrice->label }}: {{ $partialPrice->price }} @endforeach
                                                                ">
                                                                            <i class="fa-solid fa-info-circle"></i>
                                                                        </div>
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>

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
                                        @endforeach
                                    </ul>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>


    </div>

    <div class="">
        <livewire:menu-text-footer :menu_setting="$this->menuSetting" :class="'text-start mt-3 mb-3 p-1 chosen_secondary_color'" />
        <div class="d-flex justify-content-center flex-column align-items-center">
            <x-menu-allergens-footer class="mb-4" />
            <x-social-footer class="" :socials="$this->socialsLinks" />
            <x-menulight-footer class="p-0 m-2 text-light-emphasis" />
        </div>

    </div>
</div>
