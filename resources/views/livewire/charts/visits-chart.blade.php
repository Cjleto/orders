<div class="p-4 bg-white shadow rounded-3">

    <h2 class="font-semibold fs-3 text-primary ">Visits</h2>

    <div class="gap-2 mb-4 form-group d-flex align-items-center">
        <label for="period" class="">Select Period</label>
        <select id="period" wire:model.live="period" class="form-control form-control-sm w-25">
            <option value="7">Last 7 days</option>
            <option value="14">Last 14 days</option>
            <option value="30">Last 30 days</option>
        </select>
    </div>

    <div style="height: 20rem;">

        <livewire:livewire-column-chart
            :column-chart-model="$chart"
            key="{{ now() }}"
        />
    </div>
</div>
