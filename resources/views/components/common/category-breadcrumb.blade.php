@props([
    'initial_macro' => null,
    'category' => null,
    'sub_category' => null,
    'dishes' => null,
])



<nav aria-label="breadcrumb">
    <ol class="breadcrumb custom-breadcrumb">
        @if ($initial_macro)
            <li class="breadcrumb-item" aria-current="page">{{ $initial_macro->name }}</li>
        @endif

        @if ($category)
            <li class="breadcrumb-item">
                <a href="{{ route('macro_categories.show', ['macro_category' => $category->macroCategory]) }}">
                    <div class="badge-macro-category">{{ $category->macroCategory->name }}</div>
                </a>
            </li>
            <li class="breadcrumb-item ">
                <a href="{{ route('categories.show', ['category' => $category]) }}">
                    <div class="badge-category">{{ $category->name }}</div>
                </a>
            </li>
        @endif

        @if ($sub_category)
            <li class="breadcrumb-item active" aria-current="page">
                    <div class="badge-sub-category">{{ $sub_category->name }}</div>
            </li>
        @endif

        @if ($dishes)
            <li class="breadcrumb-item" aria-current="page">
                <div class="badge-dish">{{ __('Dishes') }}</div>
            </li>
        @endif
    </ol>
</nav>


<style>
    .custom-breadcrumb {
        font-size: 0.8em;
        border-radius: 0.375rem;
        padding: 0.2em 0.5em;
    }

    .custom-breadcrumb .breadcrumb-item a {
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s ease-in-out;
    }

    .custom-breadcrumb .breadcrumb-item a:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    .custom-breadcrumb .breadcrumb-item.active {
        color: #6c757d;
        font-weight: 700;
    }

    .custom-breadcrumb .breadcrumb-item+.breadcrumb-item::before {
        content: ">";
        font-weight: bolder;
        color: #6c757d;
        padding: 0 5px;
    }
</style>
