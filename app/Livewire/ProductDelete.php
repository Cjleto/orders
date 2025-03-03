<?php

namespace App\Livewire;

use App\Helpers\LivewireSwal;
use App\Models\Product;
use Livewire\Component;
use App\Services\ProductService;

class ProductDelete extends Component
{
    public Product $product;

    public function deleteProduct(ProductService $productService)
    {
        $this->product->delete();

        $this->product->clearMediaCollection('images');

        $this->dispatch('productUpdated');
        $this->dispatch('close-modal');

        LivewireSwal::make($this)
            ->success()
            ->setParams([
                'title' => trans('success') . "!",
                'text' => trans('product') . ' ' . trans('deleted'),
            ])
            ->fireSwalEvent();
    }

    public function render()
    {
        return view('livewire.product-delete');
    }
}
