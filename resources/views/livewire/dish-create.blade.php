<div class="container-fluid">

    <p class="text-center text-muted">{{ __('create_dish_steps_title') }}</p>
    <!-- Step Indicators -->
    <div class="step">
        <div class="circle active">1</div> {{-- Macro --}}
        <div class="circle @if ($selected_macro_id) active @endif">2</div> {{-- Macro Category and Sub --}}
        <div class="circle @if ($selected_category_id) active @endif">3</div> {{-- Details --}}
        <div class="circle">4</div> {{-- Allergeni --}}
    </div>

    <!-- Progress Bar -->
    <div class="progress">
        <div wire:key='progressBar{{ $progessPerc }}' class="progress-bar" role="progressbar"
            style="width: {{ $progessPerc }}%" aria-valuenow="{{ $progessPerc }}" aria-valuemin="0"
            aria-valuemax="100">{{ $progessPerc }}</div>
    </div>


    <hr>
    <div class="mt-2 mb-2 row ">
        <div class="mb-2 col-12 col-md-4 form-group">
            <label class="form-label" for="selected_macro_id">{{ __('Macro Category') }} *</label>
            <select wire:model.live="selected_macro_id" class="form-select" id="selected_macro_id"
                aria-label="Select Macro">
                <option value="">Select a {{ __('Macro Category') }}</option>
                @foreach ($availableMacroCategories as $macro_category)
                    <option value="{{ $macro_category->id }}">{{ $macro_category->name }}</option>
                @endforeach
            </select>
            @error('selected_macro_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>


        @if ($selected_macro_id)
            <div class="mb-2 col-12 col-md-4">
                <label class="form-label" for="selected_category_id_id">{{ __('Category') }} *</label>
                <select wire:model.live="selected_category_id" class="form-select" id="selected_category_id_id">
                    <option value="">Select a category</option>
                    @foreach ($availableCategories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('selected_category_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            @if ($selected_category_id) {{-- TODO verificare che esistano sub categrories --}}
                <div class="mb-2 col-12 col-md-4">
                    <label class="form-label" for="selected_sub_category_id_id">{{ __('SubCategory') }} *</label>
                    <select wire:model.live="selected_sub_category_id" class="form-select"
                        id="selected_sub_category_id_id">
                        <option value="">{{ __('Choose a sub category') }}</option>
                        <option value=0>{{ __('No sub category') }}</option>
                        @foreach ($availableSubCategories as $subCategory)
                            <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                        @endforeach
                    </select>
                    @error('selected_sub_category_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            @endif
        @endif
    </div>

    @if ($progessPerc < 100)
        <div class="container">
            <div class="row ">
                @if (!$selected_macro_id && !$selected_category_id && !$selected_sub_category_id)
                    <div class="mt-5 col-10 offset-1 col-md-6 offset-md-3">
                        <div class="p-5 h-100 rounded-3 text-bg-secondary">
                            <h2>{{ __('Choose macro') }}</h2>
                            <p>{{ __('tutorial_create_macro') }}</p>
                            <livewire:macro_category_create :btnClass="'btn btn-outline-light'" :key="'macroCreate'">
                        </div>
                    </div>
                @elseif($selected_macro_id && !$selected_category_id && !$selected_sub_category_id)
                    <div class="mt-5 col-10 offset-1 col-md-6 offset-md-3">
                        <div class="p-5 border h-100 text-bg-primary rounded-3">
                            <h2>{{ __('Choose category') }}</h2>
                            <p>{{ __('tutorial_create_category') }}</p>
                            @php
                                $macro_category = App\Models\MacroCategory::find($selected_macro_id);
                            @endphp
                            <livewire:category_create :macro_category="$macro_category" :btnClass="'btn btn-sm btn-outline-light'" :key="'categoryCreate'">
                        </div>
                    </div>
                @elseif($selected_macro_id && $selected_category_id && is_null($selected_sub_category_id))
                    <div class="mt-5 col-10 offset-1 col-md-6 offset-md-3">
                        <div class="p-5 border h-100 text-bg-teal rounded-3">
                            <h2>{{ __('Choose sub category') }}</h2>
                            <p>{{ __('tutorial_create_sub_category') }}</p>
                            @php
                                $category = App\Models\Category::find($selected_category_id);
                            @endphp
                            <livewire:sub_category_create :category="$category" :btnClass="'btn btn-outline-secondary'" :key="'subCreate'">
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif


    {{-- FORM DISH --}}
    @if ($enableDishForm)
        <livewire:dish-form :macroCategory_id="$selected_macro_id" :category_id="$selected_category_id" :subCategory_id="$selected_sub_category_id">
    @endif


    <style>
        .step {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1em;
            flex-wrap: wrap;
            /* Permette agli elementi di andare su una nuova riga se necessario */
        }

        .step .circle {
            width: 40px;
            height: 40px;
            line-height: 40px;
            border-radius: 50%;
            background-color: #ddd;
            color: white;
            text-align: center;
            font-weight: bold;
        }

        .step .active {
            background-color: #5b3cc4;
        }


        /* Media query per schermi piccoli */
        @media (max-width: 576px) {
            .step .circle {
                width: 30px;
                /* Riduce le dimensioni dei cerchi */
                height: 30px;
                line-height: 30px;
            }

            .progress-bar {
                height: 4px;
                /* Riduce l'altezza della progress bar su schermi piccoli */
            }

            h4 {
                font-size: 1.2rem;
                /* Riduce la dimensione del titolo */
            }

            .form-container {
                padding: 15px;
                /* Riduce il padding del form su schermi piccoli */
            }
        }
    </style>
</div>
