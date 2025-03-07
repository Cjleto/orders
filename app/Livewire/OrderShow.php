<?php

namespace App\Livewire;

use App\Enums\OrderStatus;
use App\Events\OrderStatusChanged;
use App\Models\Order;
use Illuminate\Support\Collection;
use Livewire\Component;

class OrderShow extends Component
{
    public Order $order;

    public array $statuses;

    public Collection $historySteps;

    public function mount()
    {
        $this->loadOrderRelationships();
        $this->statuses = OrderStatus::all();
    }

    public function updateStatus(string $status)
    {
        $this->order->update(['status' => $status]);
        $this->loadOrderRelationships();
        OrderStatusChanged::dispatch($this->order);
    }

    private function loadOrderRelationships()
    {
        $this->order->load(['items', 'customer']);
        $this->historySteps = $this->order->historySteps()->with('user')->get();
    }

    public function render()
    {
        return view('livewire.order-show');
    }
}
