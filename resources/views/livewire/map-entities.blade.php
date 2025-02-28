<div class="">
    <!-- Macro Categories Tab Navigation -->
    <ul class="mb-3 nav nav-pills" id="pills-tab" role="tablist">
        @foreach ($macroCategoriesWithDishes as $macroIndex => $macroCategory)
            <li class="nav-item" role="presentation">
                <button class="nav-link @if ($loop->first) active @endif"
                    id="pills-{{ $macroCategory['name'] }}-tab" data-coreui-toggle="pill"
                    data-coreui-target="#pills-{{ $macroCategory['name'] }}" type="button" role="tab"
                    aria-controls="pills-{{ $macroCategory['name'] }}"
                    aria-selected="@if ($loop->first) true @else false @endif">{{ $macroCategory['name'] }}</button>
            </li>
        @endforeach
    </ul>

    <div class="tab-content" id="pills-tabContent">
        @foreach ($macroCategoriesWithDishes as $macroIndex => $macroCategory)
            <div class="tab-pane fade @if ($loop->first) show active @endif"
                id="pills-{{ $macroCategory['name'] }}" role="tabpanel"
                aria-labelledby="pills-{{ $macroCategory['name'] }}-tab" tabindex="0">

                <div class="card">
                    <div class="card-header ">
                        <h4 class="card-title">{{ $macroCategory['description'] }}</h4>
                    </div>
                    <div class="card-body">

                        <!-- Categories Tab Navigation -->
                        <ul class="mb-3 nav nav-pills" id="category-pills-{{ Str::slug($macroCategory['name']) }}" role="tablist">
                            @foreach ($macroCategory['categories'] as $categoryIndex => $category)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link @if ($loop->first) active @endif"
                                        id="category-pills-{{ Str::slug($category['name']) }}-tab" data-coreui-toggle="pill"
                                        data-coreui-target="#category-pills-{{ Str::slug($category['name']) }}" type="button"
                                        role="tab" aria-controls="category-pills-{{ Str::slug($category['name']) }}"
                                        aria-selected="@if ($loop->first) true @else false @endif">{{ $category['name'] }}</button>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Categories Tab Content -->
                        <div class="tab-content" id="category-pills-tabContent">
                            @foreach ($macroCategory['categories'] as $categoryIndex => $category)
                                <div class="tab-pane fade @if ($loop->first) show active @endif"
                                    id="category-pills-{{ Str::slug($category['name']) }}" role="tabpanel"
                                    aria-labelledby="category-pills-{{ Str::slug($category['name']) }}-tab" tabindex="0">

                                    <!-- Display Category Description (if applicable) -->
                                    <div class="mb-2 d-flex justify-content-between align-items-center">
                                        <div class="text-muted">{{ $category['description'] }}</div>
                                        <div>
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('dishes.create', [
                                                    'user' => $user,
                                                    'selected_macro_id' => $category['macro_category_id'],
                                                    'selected_category_id' => $category['id'],
                                                    'selected_sub_category_id' => null,
                                                ]) }}"
                                                data-coreui-toggle="tooltip" data-coreui-placement="top"
                                                data-coreui-custom-class="custom-tooltip"
                                                data-coreui-title="{{ __('Add') }}">
                                                {{ __('Add') }} {{ __('Dish') }}
                                                <svg class="icon">
                                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-plus') }}"></use>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Dishes Without Subcategory -->
                                    @if (!empty($category['dishes_without_subcategory']))
                                        {{-- <h5>{{ __('Dishes without Subcategory') }}</h5> --}}
                                        <ul class="list-group list-group-flush hover-info rounded-4">
                                            @foreach ($category['dishes_without_subcategory'] as $dish)
                                                <li class="list-group-item">
                                                    <livewire:dish-item-map :dish_id="$dish['id']"
                                                        :wire:key="'item-dish-'.$dish['id']" />
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    <!-- Subcategories and Dishes -->
                                    @foreach ($category['sub_categories'] as $subCategory)
                                        <div class="p-2 mt-2 border-2 border-secondary rounded-4" style="border-top-style: ridge">
                                            <div
                                                class="gap-0 mt-2 d-flex justify-content-start align-items-start flex-column">
                                                <h5 class="m-0">{{ $subCategory['name'] }}</h5>
                                                <p class="mt-0 text-muted">{{ $subCategory['description'] }}</p>
                                            </div>



                                            @if (!empty($subCategory['dishes']))
                                                <ul class="list-group list-group-flush hover-info">
                                                    @foreach ($subCategory['dishes'] as $dish)
                                                        <li class="list-group-item rounded-4">
                                                            <livewire:dish-item-map :dish_id="$dish['id']"
                                                                :wire:key="'item-dish-'.$dish['id']" />
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                {{-- <div class="">
                                                    <div>
                                                        <i class="fa-solid fa-triangle-exclamation text-warning"></i>
                                                        No dishes available in this subcategory.
                                                    </div>
                                                </div> --}}
                                            @endif
                                        </div>
                                    @endforeach

                                    @if (empty($category['dishes_without_subcategory']) && empty($category['sub_categories']))
                                        {{-- <div class="">
                                            <i class="fa-solid fa-triangle-exclamation text-warning"></i>
                                            No dishes available in this category
                                        </div> --}}
                                    @endif

                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>




            </div>
        @endforeach
    </div>
</div>
