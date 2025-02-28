<div x-data="{
    selectedCategory: '{{ Str::slug($menuMap[0]['name']) }}',
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
            background-color: rgba(255, 255, 255, 0.9);
            color: black;
            border-radius: 5px;
            padding: 0px;
            margin-top: 10px;
            min-height: 65vh;
        }

        .tab-pane .list-group-item {
            background-color: rgba(255, 255, 255, 0.8);
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
            background-size: revert;
            background-attachment: fixed;
            background-repeat: initial;
            background-position: center;
            transition: opacity 0.3s ease;
        }

        .nav-tabs .nav-link-menu {
            background-color: transparent;
        }

        .nav-tabs .nav-link-menu.active {
            background-color: #fff;
        }

        .img-dish-menu {
            max-width: 100px;
            border-radius: 10%;
            box-shadow: 4px 4px 7px gray;
        }


        .description {
            max-width: 100%;
            color: {{ $this->menuSetting->tertiary_color }};
            overflow: hidden;
            text-overflow: ellipsis;
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
            background-repeat: repeat
        }
        .dish_title {
            font-weight: bold;
            color: {{ $this->menuSetting->quaternary_color }};
        }
    </style>


    <div class="contents" style="position: relative;">
        <div x-data="{ title: '{{ $this->menuSetting()->title }}' }" @title-changed.window="title = $event.detail" id="highlight-target">
            <div class="d-flex justify-content-around align-items-center">
                <h1 class="text-center " x-text="title"></h1>
                @if ($this->logo)
                    <img src="{{ $this->logo }}" alt="{{ $company['name'] }}" class="mt-2 img-fluid"
                        style="max-height: 8vh; border-radius: 15%">
                @endif
            </div>
            @if ($this->enableLanguageSwitcher)
                <div style="position: absolute; right: 0;">
                    <livewire:language-switcher :company_id="$company['id']" />
                </div>
            @endif

        </div>

        <!-- Tabs per le macrocategorie -->
        <ul class="gap-3 mb-3 nav d-flex justify-content-center font-bigger nav-tabs" id="macroCategoryTabs"
            role="tablist" :style="{ 'font-family': fontSecondary }">
            @foreach ($menuMap as $record)
                <li class="nav-item">
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
            @foreach ($menuMap as $macroCategory)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                    id="{{ Str::slug($macroCategory['name']) }}" role="tabpanel"
                    aria-labelledby="{{ Str::slug($macroCategory['name']) }}-tab">

                    <!-- Tabs per le categorie all'interno della macrocategoria -->
                    <ul class="nav nav-tabs d-flex" id="categoryTabs{{ Str::slug($macroCategory['name']) }}"
                        role="tablist">
                        @foreach ($macroCategory['categories'] as $category)
                            <li class="text-center nav-item flex-grow-1">
                                <a class="nav-link nav-link-menu chosen_primary_color {{ $loop->first ? 'active' : '' }}"
                                    id="{{ Str::slug($category['name']) }}-tab" data-coreui-toggle="tab"
                                    href="#{{ Str::slug($category['name']) }}" role="tab"
                                    aria-controls="{{ Str::slug($category['name']) }}"
                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                                    :style="{ 'font-family': fontSecondary }">
                                    {{ $category['category_obj']->getTranslatedValue('name') }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content" id="categoryContent{{ Str::slug($macroCategory['name']) }}">
                        @foreach ($macroCategory['categories'] as $category)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                id="{{ Str::slug($category['name']) }}" role="tabpanel"
                                aria-labelledby="{{ Str::slug($category['name']) }}-tab">
                                {{-- <h3>{{ $category['name'] }}</h3> --}}
                                @foreach ($category['sub_categories'] as $sub_category)
                                    <div class="mb-3 border-0 card bg-light">
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
                                                                        alt="{{ $dish->translated_name }}"
                                                                        class="img-fluid img-dish-menu">
                                                                </a>
                                                            </div>
                                                        @endif
                                                        <div class="d-flex flex-column flex-grow-1 w-100">
                                                            <div class="d-flex justify-content-between w-100">
                                                                <div class="dish_title fs-4">
                                                                    {{ $dish->translated_name }}
                                                                </div>
                                                                <!-- Spostato il prezzo qui in modo che sia visibile sempre -->
                                                                <div
                                                                    class="align-self-center price-container text-end d-md-flex">
                                                                    <span class="chosen_primary_color fs-5 text-nowrap">
                                                                        {{ $dish['price'] }}
                                                                        @if ($dish->partialPrices()->count() > 0)
                                                                            <span
                                                                                class="p-0 badge chosen_secondary_color fs-6"
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
                                                                            </span>
                                                                        @endif
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="badge rounded-pill d-none ">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="chosen_primary_color font-bigger">
                                                                        {{ $dish['price'] }}</div>
                                                                    <div class="chosen_secondary_color font-smaller">
                                                                        @if ($dish->partialPrices->isNotEmpty())
                                                                            @foreach ($dish->partialPrices as $partialPrice)
                                                                                @if (!$loop->first)
                                                                                    <br>
                                                                                @endif
                                                                                {{ $partialPrice->label }}:
                                                                                {{ $partialPrice->price }}
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                            </div>

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

                                <div class="mb-3 border-0 card bg-light">
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
                                                                alt="{{ $dish->translated_name }}"
                                                                class="img-fluid img-dish-menu">
                                                        </a>
                                                    </div>
                                                @endif
                                                <div class="d-flex flex-column flex-grow-1 w-100">
                                                    <div class="d-flex justify-content-between w-100">
                                                        <div class="dish_title fs-4">
                                                            {{ $dish->translated_name }}
                                                        </div>
                                                        <!-- Spostato il prezzo qui in modo che sia visibile sempre -->
                                                        <div
                                                            class="align-self-center price-container text-end d-md-flex">
                                                            <span class="chosen_primary_color fs-5 text-nowrap">
                                                                {{ $dish['price'] }}
                                                                @if ($dish->partialPrices()->count() > 0)
                                                                    <span
                                                                        class="p-0 badge chosen_secondary_color fs-6"
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
                                                                    </span>
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="badge rounded-pill d-none ">
                                                        <div class="d-flex justify-content-between">
                                                            <div class="chosen_primary_color font-bigger">
                                                                {{ $dish['price'] }}</div>
                                                            <div class="chosen_secondary_color font-smaller">
                                                                @if ($dish->partialPrices->isNotEmpty())
                                                                    @foreach ($dish->partialPrices as $partialPrice)
                                                                        @if (!$loop->first)
                                                                            <br>
                                                                        @endif
                                                                        {{ $partialPrice->label }}:
                                                                        {{ $partialPrice->price }}
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>

                                                    </div>

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
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <livewire:menu-text-footer :menu_setting="$this->menuSetting" :class="'text-start mt-3 mb-3 p-1 chosen_secondary_color'" />
        <div class="d-flex justify-content-center flex-column align-items-center" style="margin-bottom: 5rem">
            <x-menu-allergens-footer classContainer="mb-4" />
            <x-social-footer class="bg_chosen_secondary_color" :socials="$this->socialsLinks" />
            <x-menulight-footer class="p-0 mt-2 text-light-emphasis" />
        </div>
    </div>

</div>
