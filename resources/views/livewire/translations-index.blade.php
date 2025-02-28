<div wire:init="calculateTransArray">



    <h5 class="modal-title" id="translationsModal{{ $model->id }}Label">{{ $model->name }}:
        {{ __('Translations') }}</h5>

    <div>
        <div class="">
            <div class="d-flex justify-content-between align-items-center">
                <div>{{ __('Translations') }}</div>
            </div>
            <p class="openSans fst-italic" style="color: #8b8b8b; font-size:15px;">
                {{ __('assign_translations') }}
            </p>

            <div class="callout callout-primary align-items-center">
                <p class="openSans fst-italic" style="color: #8b8b8b; font-size:15px;">
                    {{ __('original_text') }}
                </p>
                @foreach ($model->getTranslatableFields() as $field)
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" value="{{ $model->$field }}"
                            id="floatingInputDisabled{{ $model->id . $field }}" placeholder="{{ $model->$field }}"
                            disabled>
                        <label for="floatingInputDisabled{{ $model->id . $field }}">{{ $field }}</label>
                    </div>
                @endforeach

            </div>

            <div id="legenda{{ $model->id . $field }}" class="gap-2 d-flex justify-content-center">
                <div class="badge bg-success">
                    {{ __('Translated') }}
                </div>
                <div class="badge bg-danger">
                    {{ __('Not Translated') }}
                </div>
            </div>


            <div class="" id="containerTranslationss">
                {{-- @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif --}}

                @foreach ($this->availableLanguage as $language)
                    <div class="callout callout-info align-items-center" .self>

                        <div class="d-flex justify-content-between">

                            <div
                                class="badge bg-info me-3 d-flex justify-content-start align-items-center flex-grow-0 gap-2 @if ($errors->has('text')) is-invalid @endif">
                                <div>{{ Str::upper($language->value) }}</div>
                                <div style="width: 2em">
                                    <x-dynamic-component :component="'flag-language-' . $language->value" class="" />
                                </div>
                            </div>


                        </div>

                        @foreach ($translations[$language->value] as $field => $text)
                            {{-- <livewire:input-translation :model="$model" :field="$field"
                                                :locale="$language" :key="$model->id . $field . $language->value" /> --}}


                            <div class="mt-2 row">
                                <div class="col-10">
                                    <div class="form-floating">
                                        <input
                                            wire:model.live.debounce.500ms="translations.{{ $language->value }}.{{ $field }}"
                                            wire:key='translations-{{ $model->id . $field . $language->value }}'
                                            type="text"
                                            id="text-{{ $language->value }}-{{ $model->id }}-{{ $field }}"
                                            autocomplete="off" placeholder="{{ __('Enter value') }}"
                                            @class(['form-control', 'is-invalid' => $errors->has('text')]) />
                                        <label
                                            for="text-{{ $language->value }}-{{ $model->id }}-{{ $field }}">
                                            {{ Str::ucfirst($field) }}
                                        </label>
                                    </div>
                                    @error('text')
                                        <div class="text-white badge bg-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="gap-1 col-2 d-flex align-items-center">
                                    <button
                                        wire:click="translateLive('{{ $language->value }}', '{{ $field }}')"
                                        class="btn btn-sm btn-primary">
                                        Translate!
                                    </button>
                                    <div wire:loading wire:target="translateLive('{{ $language->value }}', '{{ $field }}')"
                                        class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    @if (array_key_exists($language->value, $modified) &&
                                            array_key_exists($field, $modified[$language->value]) &&
                                            $modified[$language->value][$field]
                                    )
                                        Cambiato
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach


            </div>
        </div>
        <button type="submit" class="btn btn-primary" id="save{{ $model->id }}" wire:click='aggiorna'
            @if (!$enableSaveButton) disabled @endif>Save changes</button>
    </div>

</div>
