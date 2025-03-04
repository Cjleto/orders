<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Helpers\LivewireSwal;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use App\Repositories\Contracts\OrderRepositoryContract;
use Debugbar;

#[Lazy]
class OrderIndex extends Component
{
    use WithPagination;

    public string $search = '';

    public $paginationCount = 15;

    public function mount()
    {
        if (!empty($this->search)) {
            $this->updatedSearch($this->search);
        }
    }

    public function updatedSearch($value)
    {
        $this->resetPage(); // Important: Reset pagination when search changes
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

        Debugbar::info('orders requested');

        /** @var OrderRepository $orderRepository */
        $orderRepository = app(OrderRepositoryContract::class);
        $orders =  $orderRepository->searchByFieldPaginated(
            search: $this->search,
            field: 'id',
            paginationCount: $this->paginationCount
        );

        return $orders;
    }

    public function render(): View
    {
        return view('livewire.order-index', [
            'paginatedOrders' => $this->orders(),
        ]);
    }
}
