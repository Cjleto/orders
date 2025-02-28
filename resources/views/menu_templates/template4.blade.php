<div x-data="{
    selectedCategory: '{{ $menuMap->count() > 0 ? Str::slug($menuMap[0]['name']) : null }}',
    font: '{{ $selectedFont }}',
    fontSecondary: '{{ $selectedSecondaryFont }}',
}" @font-changed.window="font = $event.detail; console.log('Font received to:', font)"
    class="menu-container" :style="'font-family: ' + font" style="position: relative;">

    <style>
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
            z-index: -1;
        }

        .force-public-styles {
            position: fixed;
            background-size: auto;
            background-repeat: repeat
        }


        .photo-container {
            flex: 0 0 100px;
            /* Imposta una larghezza fissa per l'immagine */
        }

        .img-dish-menu {
            max-width: 100px;
            border-radius: 10%;
            /* box-shadow: 4px 4px 7px gray; */
        }

        .full-width-header {
            position: {{ \Route::current()->getName() == 'public.menu' ? 'fixed' : 'relative' }};
            top: 0;
            left: 0;
            width: 100vw;
            /* Prende tutta la larghezza della viewport */
            z-index: 1030;
            /* Assicura che si trovi sopra altri elementi */
        }

        .menu-container {
            border-radius: 0 !important;
            overflow: hidden;
            margin-top: 1.5em;
        }

        .accordion-custom {
            border: 1px solid {{ $this->menuSetting->primary_color }};
            border-radius: 0.25rem;
            margin-top: 0;
            font-size: var(--base-font-size);
        }

        .accordion-custom[aria-expanded="true"] {
            background-color: {{ $this->menuSetting->primary_color }};
            color: {{ $this->menuSetting->background_color }};
            font-size: var(--base-font-size);

        }

        .accordion-button:focus {
            box-shadow: none;
            border: 1px solid {{ $this->menuSetting->primary_color }};
        }

        .dish-row-container {
            // border-bottom: 1px solid {{ $this->menuSetting->primary_color }};
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

        .nav-link-custom.active {
            border-bottom: 2px solid {{ $this->menuSetting->primary_color }};
            border-top: 2px solid {{ $this->menuSetting->primary_color }};
        }
        .description {
            font-size: 0.9rem;
            color: {{ $this->menuSetting->tertiary_color }};
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .dish_name {
            font-size: 1.2rem;
            color: {{ $this->menuSetting->quaternary_color }};
        }
    </style>


    <nav class="navbar full-width-header text-light w-100 ">
        @if ($this->logo)
            <div>
                <img src="{{ $this->logo }}" alt="{{ $company['name'] }}" class="img-fluid ms-2"
                    style="max-height: 30px; border-radius: 10%;">
            </div>
        @endif
        @if ($this->enableLanguageSwitcher)
            <livewire:language-switcher :company_id="$company['id']" />
        @endif
        {{-- <div x-data="{ title: '{{ $this->menuSetting()->title }}' }" @title-changed.window="title = $event.detail" id="highlight-target">
            <div class="p-1 d-flex justify-content-between align-items-center">
                <h1 class="text-center " x-text="title"></h1>

            </div>

        </div> --}}
    </nav>

    <div class="container mt-4">


        <!-- Nav Tabs -->
        <ul class="gap-3 mb-3 nav d-flex justify-content-center font-bigger " id="myTab" role="tablist"
            @secondary-font-changed.window="fontSecondary = $event.detail; console.log('Secondary Font received to:', fontSecondary)"
            :style="{ 'font-family': fontSecondary }">
            @foreach ($menuMap as $record)
                @php($slug = Str::slug($record['name']))
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link nav-link-custom {{ $loop->first ? 'active' : '' }} chosen_primary_color p-0"
                        id="{{ $slug }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $slug }}"
                        type="button" role="tab" aria-controls="{{ $slug }}"
                        aria-selected="{{ $loop->first ? 'true' : '' }}">{{ $record['macro_obj']->getTranslatedValue('name') }}</button>
                </li>
            @endforeach
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="myTabContent">
            @foreach ($menuMap as $record)
                @php($slug = Str::slug($record['name']))
                <div class="tab-pane fade show {{ $loop->first ? 'active' : '' }}" id="{{ $slug }}"
                    role="tabpanel" aria-labelledby="{{ $slug }}-tab">

                    <div class="accordion accordion-flush" id="accordionFlush{{ $slug }}">

                        @foreach ($record['categories'] as $category)
                            @php($slugCategory = Str::slug($category['name']))
                            <div class="accordion-item ">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed accordion-custom" type="button"
                                        data-coreui-toggle="collapse"
                                        data-coreui-target="#flush-collapse-{{ $slugCategory }}" aria-expanded="false"
                                        aria-controls="flush-collapse-{{ $slugCategory }}">
                                        {{ $category['category_obj']->getTranslatedValue('name') }}
                                    </button>
                                </h2>
                                <div id="flush-collapse-{{ $slugCategory }}" class="accordion-collapse collapse"
                                    data-coreui-parent="#accordionFlush{{ $slug }}">
                                    <div class="accordion-body">

                                        @foreach ($category['sub_categories'] as $sub_category)
                                            @foreach ($sub_category['dishes'] as $dish)
                                                <div class="dish-row-container">

                                                    <div class="mt-2 row">
                                                        <div
                                                            class="col-8 d-flex justify-content-start align-items-center">
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
                                                            <strong
                                                                class="dish_name">{{ $dish->translated_name }}</strong>
                                                        </div>
                                                        <div class="col-4 text text-end align-content-center">
                                                            <strong>{{ $dish['price'] }}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="description">
                                                                {{ $dish->getTranslatedValue('description') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="gap-1 col-12 d-flex justify-content-start">
                                                            @foreach ($dish->allergens()->get() as $allergen)
                                                                <div class=" text-secondary ms-2" role="button"
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
                                        @endforeach


                                        @foreach ($category['dishes_without_subcategory'] as $dish)
                                            <div class="dish-row-container">

                                                <div class="mt-2 row">
                                                    <div class="col-8 d-flex justify-content-start align-items-center">
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

                                                        <strong
                                                            class="dish_name">{{ $dish->translated_name }}</strong>
                                                    </div>
                                                    <div class="col-4 text text-end align-content-center">
                                                        <strong>{{ $dish['price'] }}</strong>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="description">
                                                            {{ $dish->getTranslatedValue('description') }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="gap-1 col-12 d-flex justify-content-start">
                                                        @foreach ($dish->allergens as $allergen)
                                                            <div class=" text-secondary ms-2" role="button"
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
                            </div>
                        @endforeach

                    </div>
                </div>
            @endforeach
        </div>

        <livewire:menu-text-footer :menu_setting="$this->menuSetting" :class="'text-start mt-3 mb-3 p-1 chosen_secondary_color'" />
        <x-menu-allergens-footer class="mb-4" />
        <div class="d-flex justify-content-center flex-column align-items-center">
            <x-social-footer class="bg_chosen_primary_color" :socials="$this->socialsLinks" />
            <x-menulight-footer class="p-0 m-2 text-light-emphasis" />
        </div>

        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </div>
</div>
