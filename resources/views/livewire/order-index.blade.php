<div class="container-fluid">

    <nav class="navbar navbar-light text-secondary">
            <span class="mb-0 navbar-brand fs-3 d-flex align-items-center">
                <x-common.order-icon class="me-2 text-primary " /> {{ __('orders') }}
            </span>
    </nav>

    <div class="col-12">
        <div class="card card-secondary">
            <div class="card-header d-flex justify-content-between">
                <div class="d-flex justify-content-start align-items-center">
                    <select wire:model.live='paginationCount' class="form-select-sm ms-1">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>

                <div class="gap-2 d-flex justify-content-end align-items-center">
                    <div>
                        <input type="text" class="form-control" placeholder="{{ __('Search') }} Id"
                            wire:model.live.debounce.300ms="search">
                    </div>
                    <div>

                        <a class="btn btn-sm btn-primary"
                            href="{{ route('orders.create') }}"
                            data-coreui-toggle="tooltip" data-coreui-placement="top"
                            data-coreui-custom-class="custom-tooltip" data-coreui-title="{{ __('Add') }}">
                            <svg class="icon">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-plus') }}"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div wire:loading>
                <div class="p-3 m-4 alert alert-primary">
                    <div class="d-flex align-items-center justify-content-center">
                        <div><strong>Loading...</strong></div>
                        <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
                    </div>
                </div>
            </div>

            <div class="card-body" style="overflow-x: auto;" wire:loading.remove>

                <div class="alert alert-light">
                    <div class="d-flex justify-content-around">
                        @foreach($statuses as $status)
                            <div @class([
                                "btn btn-sm btn-outline-primary ",
                                "btn-primary text-white" => ($status->value == $filteredStatus)
                            ]) wire:click="filterStatus('{{ $status }}')" >{{ $status }}</div>
                        @endforeach
                    </div>
                </div>


                <table class="table mt-2 table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('id') }}</th>
                            <th scope="col">{{ __('customer') }}</th>
                            <th scope="col">{{ __('status') }}</th>
                            <th scope="col">{{ __('price') }}</th>
                            <th scope="col">{{ __('created_at') }}</th>
                            <th scope="col">{{ __('actions') }}</th>
                        </tr>
                    </thead>
                    <tbody >
                        @forelse ($paginatedOrders as $order)
                            <tr wire:key="order-{{ $order->id }}">

                                <td>
                                    <div class="fw-bold">{{ $order->id }}</div>
                                </td>

                                <td>
                                    <div class="fw-bold">{{ $order->customer->full_name }}</div>
                                </td>

                                <td>
                                    <span class="text-muted fs-6">{{ $order->status }}</span>
                                </td>

                                <td>{{ $order->total }}</td>

                                <td>
                                    <div class="text-muted fs-6">{{ $order->created_at->format('Y-m-d') }}</div>
                                </td>

                                <td>
                                    <div class="gap-2 d-flex align-items-center justify-content-start" wire:ignore.self>
                                        <a href="{{ route('orders.show', $order) }}"
                                            class="btn btn-sm btn-primary"
                                            data-coreui-toggle="tooltip" data-coreui-placement="top"
                                            data-coreui-custom-class="custom-tooltip" data-coreui-title="{{ __('Show') }}">
                                            <svg class="icon">
                                                <use xlink:href="{{ asset('icons/coreui.svg#cil-magnifying-glass') }}"></use>
                                            </svg>
                                        </a>
                                        {{-- @livewire(
                                            'order-edit',
                                            [
                                                'order' => $order,
                                            ],
                                            key('order-form-' . $order->id)
                                        )
                                        @livewire(
                                            'order-delete',
                                            [
                                                'order' => $order,
                                            ],
                                            key('order-delete-' . $order->id)
                                        ) --}}

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    <x-common.badge-no-results>{{ __('no_orders_found') }}</x-common.badge-no-results>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $paginatedOrders->links() }}
            </div>
        </div>
    </div>

</div>
