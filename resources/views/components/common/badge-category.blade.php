@props(['categories_count', 'macro_category'])

<div>

    <div class="badge-category" data-coreui-toggle="tooltip" data-coreui-placement="top"
        title="{{ __('Categories') }}">

        <i class="fa-solid fa-bars me-2"></i>
        Categorie
            <a href="{{ route('macro_categories.show', ['macro_category' => $macro_category->id]) }}"
                class="badge text-bg-light rounded-pill align-items-center">{{ $categories_count }}</a>
    </div>
</div>
