<div>
    <div class="card border-primary">
        <div class="card-body">
            <form wire:submit.prevent='save'>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label class="form-label" for="background_color">Background Color</label>
                            <input name="background_color" id="background_color" wire:model="background_color"
                                @class([
                                    'custom-color-picker',
                                    'is-invalid' => $errors->has('background_color'),
                                ]) />
                                @error('background_color')
                                    <div class=" text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label class="form-label" for="primary_color">Main Color</label>
                            <input name="primary_color" id="primary_color" wire:model="primary_color"
                                @class([
                                    'custom-color-picker',
                                    'is-invalid' => $errors->has('primary_color'),
                                ]) />
                            @error('primary_color')
                                <div class=" text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label class="form-label" for="secondary_color">Secondary Color</label>
                            <input name="secondary_color" id="secondary_color" wire:model="secondary_color"
                                @class([
                                    'custom-color-picker',
                                    'is-invalid' => $errors->has('secondary_color'),
                                ]) />

                        </div>
                        @error('secondary_color')
                            <div class=" text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                            <label class="form-label" for="tertiary_color">Tertiary Color</label>
                            <input name="tertiary_color" id="tertiary_color" wire:model="tertiary_color"
                                @class([
                                    'custom-color-picker',
                                    'is-invalid' => $errors->has('tertiary_color'),
                                ]) />

                        </div>
                        @error('tertiary_color')
                            <div class=" text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                            <label class="form-label" for="quaternary_color">Quaternary Color</label>
                            <input name="quaternary_color" id="quaternary_color" wire:model="quaternary_color"
                                @class([
                                    'custom-color-picker',
                                    'is-invalid' => $errors->has('quaternary_color'),
                                ]) />

                        </div>
                        @error('quaternary_color')
                            <div class=" text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-2 row">
                    <div class="col-12">
                        <div class="form-group " x-data="{ titleAlpine: '{{ $title }}' }">

                            <label class="form-label" for="title">{{ __('Title') }}</label>
                            <input type="text" id="title" x-model="titleAlpine" min="0" max="1"
                                @class(['form-control', 'is-invalid' => $errors->has('title')])
                                @input="$dispatch('title-changed', titleAlpine); @this.set('title', titleAlpine)" />
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>



                <div class="mt-1 row">
                    {{-- <div class="col-4">
                        <div x-data="{ opacity: {{ $backgroundOpacity }} }" class="form-group align-items-center">
                            <label for="opacity">Opacità dello sfondo</label>
                            <input type="range" id="opacity" x-model="opacity" min="0" max="1"
                                step="0.1" class="form-range mt-3 @error('backgroundOpacity') is-invalid @enderror"
                                @input="$dispatch('opacity-changed', opacity, @this.set('backgroundOpacity', opacity))" />
                            @error('backgroundOpacity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> --}}
                    <div class="col-4">
                        <div class="form-group">
                            <label for="template" class="form-label">{{ __('Template') }}</label>
                            <select id="template" name="template" wire:model.live="template"
                                class="form-select @error('template') is-invalid @enderror">
                                <option value="">{{ __('Select a template') }}</option>
                                <option value="template1">{{ __('Template 1') }}</option>
                                <option value="template2">{{ __('Template 2') }}</option>
                                <option value="template3">{{ __('Template 3') }}</option>
                                <option value="template4">{{ __('Template 4') }}</option>
                                <option value="templatebistrot">{{ __('Template bistrot') }}</option>
                            </select>
                            @error('template')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div x-data="{ newFont: '{{ $selectedFont }}', }" class="form-group ">
                            <label class="form-label" for="font-select">Select Font:</label>
                            <select id="font-select" wire:model="selectedFont"
                                @change="newFont = $event.target.value; $dispatch('font-changed', newFont, console.log('Font changed to', newFont));"
                                class="form-select @error('selectedFont') is-invalid @enderror"
                                :style="{ fontFamily: newFont }">
                                @php
                                    $lastGroup = null; // Inizializza la variabile per tenere traccia del gruppo precedente
                                @endphp

                                @foreach (\App\Enums\FontFamilyEnum::cases() as $font)
                                    @php
                                        $currentGroup = $font->getGroup(); // Supponiamo che getGroup() restituisca la categoria del font
                                    @endphp

                                    @if ($currentGroup !== $lastGroup)
                                        {{-- @if ($lastGroup !== null)
                                            <option disabled>{{ $lastGroup }}</option>
                                            <!-- Opzione disabilitata come separatore -->
                                        @endif --}}
                                        <option disabled>
                                            <== {{ $currentGroup }}==>
                                        </option>
                                        <!-- Aggiungi il nuovo gruppo come separatore -->
                                        @php
                                            $lastGroup = $currentGroup; // Aggiorna il gruppo precedente
                                        @endphp
                                    @endif

                                    <option value="{{ $font->value }}" style="font-family: {{ $font->value }};">
                                        {{ $font->value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('selectedFont')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- FONT SECONDARY --}}
                    <div class="col-4">
                        <div x-data="{ newFontSecondary: '{{ $selectedFontSecondary }}', }" class="form-group ">
                            <label class="form-label" for="font-secondary-select">Select Secondary Font:</label>
                            <select id="font-secondary-select" wire:model="selectedFontSecondary"
                                @change="newFontSecondary = $event.target.value; $dispatch('secondary-font-changed', newFontSecondary, console.log('Secondary Font changed to', newFontSecondary));"
                                class="form-select @error('selectedFontSecondary') is-invalid @enderror"
                                :style="{ fontFamily: newFontSecondary }">
                                @php
                                    $lastGroup = null; // Inizializza la variabile per tenere traccia del gruppo precedente
                                @endphp

                                @foreach (\App\Enums\FontFamilyEnum::cases() as $font)
                                    @php
                                        $currentGroup = $font->getGroup(); // Supponiamo che getGroup() restituisca la categoria del font
                                    @endphp

                                    @if ($currentGroup !== $lastGroup)
                                        {{-- @if ($lastGroup !== null)
                                            <option disabled>{{ $lastGroup }}</option>
                                            <!-- Opzione disabilitata come separatore -->
                                        @endif --}}
                                        <option disabled>
                                            <== {{ $currentGroup }}==>
                                        </option>
                                        <!-- Aggiungi il nuovo gruppo come separatore -->
                                        @php
                                            $lastGroup = $currentGroup; // Aggiorna il gruppo precedente
                                        @endphp
                                    @endif

                                    <option value="{{ $font->value }}" style="font-family: {{ $font->value }};">
                                        {{ $font->value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('selectedFontSecondary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>

                {{-- <div class="row">
                    <div class="col-12">
                        <div class="mb-3 form-group">
                            <label for="newMenuWallpaper" class="form-label">Menu wallpaper *</label>
                            <input id="newMenuWallpaper" name="newMenuWallpaper" type="file" wire:model="newMenuWallpaper"
                                class="form-control @error('newMenuWallpaper') is-invalid @enderror"
                                accept="image/png, image/jpg, image/jpeg, image/gif">
                            @error('newMenuWallpaper')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div> --}}


                {{-- <div class="row">
                    <div class="col-6">
                        @if ($newMenuWallpaper)
                            <div class="text-center card border-top-3 border-top-warning">
                                <div class="card-header">
                                    <p class="card-text">{{ __('New Wallpaper') }}</p>
                                </div>
                                <div class="card-body align-items-center">
                                    <img src="{{ $newMenuWallpaper->temporaryUrl() }}" alt="Preview"
                                        class="mt-2 img-thumbnail" width="150">
                                </div>
                            </div>
                        @endif
                        @error('newMenuWallpaper')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        @if ($menuWallpaperUrl)
                            <div class="text-center card border-top-3 border-top-primary">
                                <div class="gap-1 card-header d-flex justify-content-center">
                                    <div class="card-text">{{ __('Current Wallpaper') }}</div>
                                    <div>
                                        <div class="p-0 btn btn-danger btn-sm" wire:click="deleteMenuWallpaper">
                                            {{ __('Delete') }}</div>
                                    </div>
                                </div>
                                <div class="card-body align-content-center">
                                    <img src="{{ $menuWallpaperUrl }}" alt="Attuale"
                                        class="card-img-topmt-2 img-thumbnail" width="150">
                                </div>
                            </div>
                        @endif
                    </div>
                </div> --}}

                <div class="row">
                    <div class="col-12">
                        <div class="mt-3 form-group">
                            <label for="textFooter" class="form-label">{{ __('text_footer_label') }}</label>
                            <textarea type="text" id="textFooter" wire:model="textFooter"
                                class="form-control @error('textFooter') is-invalid @enderror"></textarea>
                            @error('textFooter')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group d-flex justify-content-end ">
                    <button type="submit" class="mt-3 btn btn-primary">{{ __('Save') }}
                        {{ __('Settings') }}</button>
                </div>
            </form>
        </div>

    </div>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
    <style>
        .pcr-button {
            border: 2px solid #ccc;
        }
    </style>
</div>
@script
    <script>
        Livewire.hook('element.init', ({
            component,
            cleanup
        }) => {

            function initializePickr() {
                // Seleziona tutti gli elementi con la classe 'custom-color-picker'
                const colorPickers = document.querySelectorAll('.custom-color-picker');

                colorPickers.forEach((colorPickerElement) => {

                    const wireModel = colorPickerElement.getAttribute('wire:model');

                    const pickr = Pickr.create({
                        el: colorPickerElement,
                        theme: 'classic', // Utilizza il tema 'classic'
                        default: @this.get(wireModel), // Colore di default
                        swatches: [
                            '#f44336', '#e91e63', '#9c27b0', '#673ab7', '#3f51b5', '#2196f3',
                            '#00bcd4', '#009688', '#4caf50', '#ffeb3b', '#ff9800', '#795548',
                            '#ffffff', '#777777',  '#000000',

                        ],
                        components: {
                            preview: true,
                            opacity: false,
                            hue: true,
                            interaction: {
                                hex: false,
                                rgba: false,
                                input: true,
                                clear: false,
                                save: true
                            }
                        }
                    });

                    pickr.on('save', (color) => {
                        const hexColor = color.toHEXA().toString();
                        // Ottieni l'attributo wire:model dall'elemento input

                        // Aggiorna il modello Livewire
                        @this.set(wireModel, hexColor);

                        // Aggiorna il valore dell'input
                        colorPickerElement.value = hexColor;

                        /* console.log(colorPickerElement);
                        const className = `chosen_${colorPickerElement.name}`;
                        console.log(className);

                        // cambia in live con alpine il colore nel publi-menu. accedo al tag style tramite id nel tag
                        const styleElement = document.getElementById('pulic-menu-style');

                        // Ottieni il foglio di stile corretto
                        const styleSheet = styleElement.sheet; // Ottieni l'oggetto CSSStyleSheet

                        // Funzione per trovare e rimuovere una regola
                        function updateCssRule(selector, newRule) {
                            // Trova l'indice della regola esistente
                            for (let i = 0; i < styleSheet.cssRules.length; i++) {
                                const rule = styleSheet.cssRules[i];

                                // Se la regola esiste, rimuovila
                                if (rule.selectorText === selector) {
                                    styleSheet.deleteRule(i);
                                    console.log('Regola rimossa: ' + selector);
                                    break;
                                }
                            }

                            // Aggiungi la nuova regola
                            styleSheet.insertRule(`${selector} { ${newRule} }`, styleSheet.cssRules
                                .length);

                            console.log(styleSheet.cssRules);
                        }

                        // Esempio: aggiorna il colore di .chosen_primary
                        updateCssRule(`.${className}`, `color: ${hexColor} !important`); */

                    });
                });
            }

            initializePickr();
        });
    </script>
@endscript
