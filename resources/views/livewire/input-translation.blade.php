<div>
    <div class="mt-2 row">
        <div class="col-10">
            <div class="form-floating">
                <input wire:model.live.debounce.500ms="text" type="text"
                    class="form-control @if ($errors->has('text')) is-invalid @endif"
                    id="text-{{ $locale->value }}-{{ $model->id }}" autocomplete="off"
                    placeholder="{{ __('Enter value') }}" />
                <label for="text-{{ $locale->value }}-{{ $model->id }}">
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
            <button wire:click="translateLive()" class="btn btn-sm btn-primary" @if(!$enableButton) disabled @endif >
                Translate!
            </button>
        </div>
    </div>
</div>
