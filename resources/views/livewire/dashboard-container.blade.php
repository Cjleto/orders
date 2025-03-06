<div>
    <div class="my-3 text-center d-flex justify-content-center flex-column">
        <h4 class="mb-1">{{ __('dashboard_select_dates') }}</h4>
        <div class="input-group">
            <input type="date" class="form-control" wire:model.change="startDate">
            <input type="date" class="form-control ms-2" wire:model.change="endDate">
        </div>
    </div>

    <div class="flex-wrap gap-2 mb-3 d-flex justify-content-around">
        <x-status-card
            title="In Elaborazione"
            count="{{ $countByStatus['in elaborazione'] ?? 0 }}"
            color="bg-primary"
            icon="fas fa-cogs"
        />
        <x-status-card
            title="Spedito"
            count="{{ $countByStatus['spedito'] ?? 0 }}"
            color="bg-warning"
            icon="fas fa-shipping-fast"
        />
        <x-status-card
            title="Consegnato"
            count="{{ $countByStatus['consegnato'] ?? 0 }}"
            color="bg-success"
            icon="fas fa-box-open"
        />
        <x-status-card
            title="Revenue"
            count="{{ $totalRevenue }}"
            color="bg-danger"
            icon="fas fa-box-open"
        />
    </div>

    <div class="mb-2 row" style="min-height: 200px;">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ trans('orders_evolution') }}
                </div>
                <div class="card-body">
                    <livewire:livewire-line-chart
                        key="{{ $ordersAmounForRange->reactiveKey() }}"
                        :line-chart-model="$ordersAmounForRange" />
                </div>
            </div>
        </div>
    </div>

    <div class="mb-2 row" style="min-height: 200px;">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ trans('orders_per_day') }}
                </div>
                <div class="card-body">
                    <livewire:livewire-column-chart
                        key="{{ $ordersCountForRange->reactiveKey() }}"
                        :column-chart-model="$ordersCountForRange" />
                </div>
            </div>
        </div>
    </div>

</div>
