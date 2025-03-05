<div>

    <div class="card">
        <div class="card-header">
            <h3>{{ __('order') }} {{ __('details') }}</h3>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <div class="card-text"><strong>ID:</strong> {{ $order->id }}</div>
                    <div class="card-text"><strong>Status:</strong> {{ $order->status }}</div>
                    <div class="card-text"><strong>Total:</strong> {{ $order->formatted_total }}</div>
                    <div class="card-text"><strong>Customer:</strong> {{ $order->customer->full_name }}</div>
                </div>
                <div class="gap-1 d-flex flex-column">
                    @foreach ($statuses as $status)
                        <button wire:click="updateStatus('{{ $status }}')"
                            class="btn btn-{{ $order->status !== $status ? 'primary' : 'secondary' }}"
                            @disabled($order->status == $status)>{{ $status }}</button>
                    @endforeach
                </div>
            </div>

        </div>
    </div>


    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mt-4 card">
                <div class="card-header">
                    <h3>{{ __('order') }} {{ __('items') }}</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($order->items as $item)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="card-text"><strong>Product:</strong> {{ $item->product_name }}</div>
                                        <div class="card-text"><strong>Quantity:</strong> {{ $item->quantity }}</div>
                                        <div class="card-text"><strong>Price:</strong> {{ $item->formatted_price }}</div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="mt-4 card">
                <div class="card-header">
                    <h3>{{ __('order') }} {{ __('history') }}</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($historySteps as $step)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="card-text"><strong>{{ __('status') }}:</strong> {{ $step->status }}</div>
                                        <div class="card-text"><strong>{{ __('causer') }}:</strong> {{ $step->user->name }}</div>
                                        <div class="card-text"><strong>{{ __('date') }}:</strong> {{ $step->created_at }}</div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>

</div>
