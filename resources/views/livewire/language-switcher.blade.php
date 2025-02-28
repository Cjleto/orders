<div>

    <div class="p-1 me-3 d-flex justify-content-end">
        <div class="btn-group dropstart">
            <div class="dropdown-toggle dropdown-toggle-split" type="button" id="languageDropdown"
                data-coreui-toggle="dropdown" aria-expanded="false">
                <x-dynamic-component :component="'flag-language-'.$selectedLanguage" class="" width="25px" height="25px" />
                {{-- <span id="currentLanguage">English</span> <!-- Testo lingua corrente --> --}}
            </div>
            <ul class="dropdown-menu" aria-labelledby="languageDropdown">

                <li>
                    <div class="dropdown-item" wire:click="changeLanguage('it')">
                        <div class="gap-2 d-flex justify-content-start">
                            <x-dynamic-component :component="'flag-language-it'" width="20px" />
                            <div>Italiano</div>
                        </div>
                    </div>
                </li>

                @foreach ($this->availableLanguages as $language)
                    <li>
                        <div class="dropdown-item" wire:click="changeLanguage('{{ $language->value }}')">
                            <div class="gap-2 d-flex justify-content-start">
                                <x-dynamic-component :component="'flag-language-' . $language->value" width="20px" />
                                <div>{{ $language->getDescription() }}</div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
