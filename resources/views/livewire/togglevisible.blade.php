<?php

use App\Enums\IsVisible;
use Livewire\Volt\Component;
use App\Models\MacroCategory;
use Illuminate\Database\Eloquent\Model;

new class extends Component {
    public Model $model;
    public $visibility;

    protected $listeners = ['toggleVisible' => '$refresh'];

    public function mount()
    {
        $this->visibility = $this->model->is_visible;
    }

    public function toggleVisible()
    {
        Debugbar::info($this->model->is_visible);
        $newValue = $this->model->is_visible == IsVisible::VISIBLE ? IsVisible::INVISIBLE : IsVisible::VISIBLE;
        $this->model->is_visible = $newValue;
        Debugbar::info($this->model->is_visible);
        $this->model->save();

        $this->visibility = $this->model->is_visible;

        $this->dispatch('hideTooltip');
    }
}; ?>

<div>
    @if ($visibility == IsVisible::VISIBLE)
        <button wire:click="toggleVisible" class="text-white btn btn-sm btn-success" data-coreui-toggle="tooltip"
            data-coreui-placement="top" data-coreui-title="Visibile" data-coreui-placement="right">
            <i class="fa-solid fa-eye"></i>
        </button>
    @else
        <button wire:click="toggleVisible" class="text-white btn btn-sm btn-danger" data-coreui-toggle="tooltip"
            data-coreui-placement="top" data-coreui-title="Nascosto">
            <i class="fa-solid fa-eye-slash"></i>
        </button>
    @endif
</div>

<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('hideTooltip', function() {
            /* var tooltipButton = document.getElementById('tooltip-button');
            var tooltipInstance = bootstrap.Tooltip.getInstance(tooltipButton);
            if (tooltipInstance) {
                tooltipInstance.hide();
            } */

            // get all tooltips
            var tooltipList = document.querySelectorAll('[data-coreui-toggle="tooltip"]');
            // iterate over each tooltip
            tooltipList.forEach(function(tooltip) {
                // get the tooltip instance
                var tooltipInstance = bootstrap.Tooltip.getInstance(tooltip);
                // if the instance exists, hide it
                if (tooltipInstance) {
                    tooltipInstance.hide();
                }
            });
        });
    });
</script>
