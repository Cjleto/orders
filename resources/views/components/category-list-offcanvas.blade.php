<div>
    <button class="btn btn-sm btn-primary" type="button" data-coreui-toggle="offcanvas"
        data-coreui-target="#offcanvasRight" aria-controls="offcanvasRight">{{ __('show_category_dishes_list') }}</button>

    <div class="offcanvas offcanvas-end cj-custom-offcanvas-width" tabindex="-1" id="offcanvasRight"
        aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">{{ __('Dishes') }} in
                {{ $subCategory?->name ?? $category?->name }}</h5>
            <button type="button" class="btn-close" data-coreui-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-group list-group-flush">
                @foreach ($dishes as $cat_name => $sub_category)
                    <li class="list-group list-group-item d-flex justify-content-between">
                        <div class="d-flex align-items-center justify-content-center">
                            {{ $cat_name }}
                            @if ($cat_name == $subCategory?->name ?? $category?->name)
                                <span class="text-white badge bg-primary ms-2">{{ __('selected') }}</span>
                            @endif
                        </div>

                        @foreach ($sub_category as $dish)
                            <!-- Some borders are removed -->
                    <li class="list-group-item d-flex justify-content-between">
                        <div class="gap-1 d-flex align-items-start">

                            <a href="{{ route('category.dishes.index', [
                                'category' => $category,
                                'search' => $dish->name,
                            ]) }}"
                                class="text-decoration-none"
                                target="_alt">
                                <i class="fa-solid fa-info-circle"></i>
                            </a>
                            <span>{{ $dish->name }}</span>
                        </div>
                        <span>{{ $dish->price }} €</span>
                    </li>
                @endforeach
                </li>
                @endforeach

            </ul>
        </div>
    </div>



</div>
