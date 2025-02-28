@props(['visibility', 'class' => ''])

@if ($visibility == App\Enums\IsVisible::VISIBLE)
    <div {{ $attributes->merge(['class' => 'btn btn-sm btn-success ' . $class]) }} data-coreui-toggle="tooltip"
        data-coreui-placement="top" data-coreui-title="Visibile" data-coreui-placement="right">
        <i class="fa-solid fa-eye"></i>
    </div>
@else
    <div {{ $attributes->merge(['class' => 'btn btn-sm btn-danger ' . $class]) }} data-coreui-toggle="tooltip"
        data-coreui-placement="top" data-coreui-title="Nascosto">
        <i class="fa-solid fa-eye-slash"></i>
    </div>
@endif
