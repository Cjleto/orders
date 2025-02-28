<?php

use Livewire\Volt\Component;

new class extends Component {

    public string $title = 'Help Info';



}; ?>

<div>
    <i class="fa-regular fa-circle-question fs-4 text-warning" type="button" data-coreui-toggle="offcanvas"
    data-coreui-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"></i>

    <div class="offcanvas offcanvas-end" data-coreui-scroll="true" tabindex="-1" id="offcanvasWithBothOptions"
        aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">{{ $title }}</h5>
            <button type="button" class="btn-close" data-coreui-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul>
                <li>{{ __('helpinfo.DragDropOrder') }}</li>
                <li>{{ __('helpinfo.EditDish') }}</li>
                <li>{{ __('helpinfo.AssignAllergens') }}</li>
                <li>{{ __('helpinfo.AssignPeculiarities') }}</li>
                <li>{{ __('helpinfo.SetVisibility') }}</li>
            </ul>
        </div>
    </div>
</div>
