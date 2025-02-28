@props(['category', 'sub_categories_count'])

<div>
    <span class="badge-sub-category text-bg-info rounded-pill" data-coreui-toggle="tooltip" data-coreui-placement="top"
        title="{{ __('Sub Categories') }}">
        <i class="fa-solid fa-minus me-2"></i>
        Sub Categorie
        <a href="{{ route('categories.show', ['category' => $category->id]) }}"
            class="badge text-bg-light rounded-pill align-items-center">{{ $sub_categories_count }}</a>
    </span>
</div>
