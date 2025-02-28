<div >

    <!-- Button trigger modal -->
    <button type="button" class="text-white btn btn-sm bg-info position-relative" data-coreui-toggle="modal"
        data-coreui-target="#translationsModal{{ $model->id }}">
        <x-common.translations-icon />
        {{-- @if ($countTranslations > 0)
            <span class="top-0 position-absolute start-100 translate-middle badge rounded-pill bg-danger">
                {{ $countTranslations }}
                <span class="visually-hidden">{{ __('Translations') }}</span>
            </span>
        @endif --}}
    </button>

    <!-- Modal -->
    <div wire:ignore.self class="modal modal-xl fade" id="translationsModal{{ $model->id }}" tabindex="-1"
        aria-labelledby="translationsModal{{ $model->id }}Label" aria-hidden="true" data-coreui-backdrop="static"
        data-coreui-keyboard="false">
        <div x-data="{ isTranslatingLive: @entangle('isTranslatingLive')}" class="modal-dialog modal-fullscreen-md-down modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="translationsModal{{ $model->id }}Label">{{ $model->name }}:
                        {{ __('Translations') }}</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

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
                                            id="floatingInputDisabled{{ $model->id . $field }}"
                                            placeholder="{{ $model->$field }}" disabled>
                                        <label
                                            for="floatingInputDisabled{{ $model->id . $field }}">{{ $field }}</label>
                                    </div>
                                @endforeach

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
                                    <div class="callout callout-info align-items-center" wire:ignore.self>

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
                                                            @class([
                                                                'form-control',
                                                                'is-invalid' => $errors->has('text'),
                                                                'border-warning' =>
                                                                    isset($modified[$language->value]) &&
                                                                    isset($modified[$language->value][$field]) &&
                                                                    $modified[$language->value][$field],
                                                            ]) />
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
                                                        wire:click="translateLive('{{ $language->value }}', '{{ $field }}'), $wire.isTranslatingLive = true"
                                                        @class(['btn btn-sm btn-primary'])
                                                        x-bind:disabled="isTranslatingLive"
                                                        >
                                                        Translate!


                                                    </button>
                                                    <div x-show="isTranslatingLive" class="spinner-border spinner-border-sm text-light"
                                                                role="status">
                                                                <span class="visually-hidden">Loading...</span>
                                                        </div>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-primary" id="save{{ $model->id }}" wire:click='save'
                        @if (!$enableSaveButton) disabled @endif>Save changes</button>
                </div>
            </div>
        </div>
    </div>

</div>
