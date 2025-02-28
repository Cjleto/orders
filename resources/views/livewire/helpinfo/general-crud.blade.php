<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Computed;

new class extends Component {

    public string $title = 'Help Info';
    public string $type;

    #[Computed]
    public function keys()
    {

        switch($this->type) {
            case 'macro':
                return [
                    'DragDropOrder',
                    'EditDetails',
                    'SetVisibility',
                    'goToCategories',
                    'goToDishes',
                ];
            case 'category':
                return [
                    'DragDropOrder',
                    'EditDetails',
                    'SetVisibility',
                    'goToSubCategories',
                    'goToDishes',
                ];
            case 'sub-category':
                return [
                    'DragDropOrder',
                    'EditDetails',
                    'SetVisibility',
                    'goToDishes',
                ];
            case 'dish':
                return [
                    'DragDropOrder',
                    'EditDetails',
                    'SetVisibility',
                ];
            default:
                return [];
        }
    }


}; ?>

<div>
    <i class="fa-regular fa-circle-question fs-4 text-warning" type="button" data-coreui-toggle="offcanvas"
    data-coreui-target="#offcanvasHelpInfo" aria-controls="offcanvasHelpInfo"></i>

    <div class="offcanvas offcanvas-end" data-coreui-scroll="true" tabindex="-1" id="offcanvasHelpInfo"
        aria-labelledby="offcanvasHelpInfoLabel">
        <div class="offcanvas-header bg-primary-subtle d-flex justify-content-between">
            <h5 class="offcanvas-title" id="offcanvasHelpInfoLabel">{{ $title }}</h5>
            <button type="button" class="btn-close" data-coreui-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul>
                @foreach($this->keys as $key)
                    <li>{!! __('helpinfo.'.$key) !!}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
