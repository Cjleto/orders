<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Helpers\LivewireSwal;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use App\Repositories\Contracts\ProductRepositoryContract;
use Debugbar;

#[Lazy]
class ProductIndex extends Component
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
        $this->products();
    }

    #[Computed()]
    #[On('productUpdated')]
    public function products()
    {

        Debugbar::info('products requested');

        $productRepository = app(ProductRepositoryContract::class);
        $products =  $productRepository->searchByField(
            search: $this->search,
            field: 'description',
            paginationCount: $this->paginationCount
        );

        return $products;

    }

    public function render(): View
    {
        return view('livewire.product-index', [
            'paginatedProducts' => $this->products(),
        ]);
    }
}
