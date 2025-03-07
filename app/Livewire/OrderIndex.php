<?php

namespace App\Livewire;

use Debugbar;
use App\Models\Order;
use Livewire\Component;
use App\Enums\OrderStatus;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Helpers\LivewireSwal;
use Livewire\Attributes\Lazy;
use App\Services\OrderService;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use App\Repositories\Contracts\OrderRepositoryContract;

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
        if (!empty($this->search)) {
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
