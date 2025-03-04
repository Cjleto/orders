@props(['class' => ''])

<div {{ $attributes->merge(['class' => ' ' . $class]) }}>
    <i class="fa-solid fa-truck"></i>
    {{ $slot }}
</div>
