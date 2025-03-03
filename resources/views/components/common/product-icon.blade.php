@props(['class' => ''])

<div {{ $attributes->merge(['class' => ' ' . $class]) }}>
    <i class="fa-solid fa-bag-shopping"></i>
    {{ $slot }}
</div>
