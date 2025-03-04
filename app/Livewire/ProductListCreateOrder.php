<?php

namespace App\Livewire;

use Debugbar;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Reactive;
use Illuminate\Contracts\View\View;
use App\Repositories\Contracts\ProductRepositoryContract;

#[Lazy]
class ProductListCreateOrder extends Component
{

    public $products;
    public $searchString = '';

    #[Reactive]
    public $orderItems;

    public function mount()
    {
        $this->loadProducts($this->searchString);
    }

    #[On('searchProductUpdated')]
    public function loadProducts(string $value)
    {
        //Debugbar::info('received searchProductUpdated event: '. $value);

        /** @var productRepository $productRepository */
        $productRepository = app(ProductRepositoryContract::class);
        $products = $productRepository->findAll();

        if(!empty($value)) {
            $products = $products->filter(function ($product) use ($value) {
                return str_contains(strtolower($product->name), strtolower($value));
            });
        }

        $this->products = $products->take(20);

    }

    public function addProduct(Product $product)
    {
        $this->dispatch('productAdded', $product);

        Debugbar::info('received productAdded event: '. $product);
    }

    public function removeProduct(Product $product)
    {
        $this->dispatch('productRemoved', $product);

        Debugbar::info('received productRemoved event: '. $product);
    }

    public function orderItemQuantity(Product $product)
    {
        $existingItemKey = $this->orderItems->search(function ($item) use ($product) {
            return $item['product_id'] === $product->id;
        });

        if ($existingItemKey !== false) {
            return $this->orderItems[$existingItemKey]['quantity'];
        }

        return 0;
    }

    public function render(): View
    {
        return view('livewire.product-list-create-order');
    }
}
