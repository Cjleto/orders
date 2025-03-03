@props(['class' => ''])

<div {{ $attributes->merge(['class' => 'badge bg-warning p-2 ' . $class]) }}>
    {{ $slot }}
</div>
