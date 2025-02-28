@props(['category' => null, 'subCategory' => null, 'dishes_count'])

<div>
    <span class="badge-dish" data-coreui-toggle="tooltip" data-coreui-placement="top"
        title="{{ __('Dishes') }}">
        <i class="fa-solid fa-utensils me-2"></i>
            Piatti
            @if($subCategory)
                <a href="{{ route('sub_category.dishes.index', ['sub_category' => $subCategory->id]) }}"
                    class="badge text-bg-light rounded-pill align-items-center">{{ $dishes_count }}</a>
            @elseif ($category)
                <a href="{{ route('category.dishes.index', ['category' => $category->id]) }}"
                    class="badge text-bg-light rounded-pill align-items-center">{{ $dishes_count ?? 0 }}</a>
            @else
                <div class="badge text-bg-light rounded-pill align-items-center">0</div>
            @endif

    </span>
</div>
