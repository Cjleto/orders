<?php

namespace App\Livewire;

use App\Enums\OrderStatus;
use App\Services\OrderService;
use Debugbar;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy]
class OrderIndex extends Component
{
    use WithPagination;

    public string $search = '';

    public $paginationCount = 15;

    public array $statuses = [];

    public string $filteredStatus = '';

    public function mount()
    {
        if (! empty($this->search)) {
            $this->updatedSearch($this->search);
        }

        $this->statuses = OrderStatus::cases();
    }

    public function updatedSearch($value)
    {
        $this->resetPage();
    }

    public function filterStatus($value)
    {
        $this->filteredStatus = $value;
        $this->resetPage();
    }

    public function updatedPaginationCount(int $value): void
    {
        $this->resetPage();
        $this->orders();
    }

    #[Computed()]
    #[On('orderUpdated')]
    public function orders()
    {

        $orderService = app()->make(OrderService::class);
        Debugbar::info('orders requested');

        $searchData = [
            'id' => $this->search,
            'status' => $this->filteredStatus,
        ];

        $orders = $orderService->getOrderIndexData($searchData, ['customer', 'products']);

        return $orders;
    }

    public function render(): View
    {
        return view('livewire.order-index', [
            'paginatedOrders' => $this->orders(),
        ]);
    }
}
