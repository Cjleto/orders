<?php

namespace App\Livewire;

use Livewire\Component;
use App\DTO\ProductStoreDTO;
use App\Helpers\LivewireSwal;
use App\Http\Requests\ProductRequest;
use Livewire\WithFileUploads;
use App\Services\ProductService;

class ProductCreate extends Component
{

    use WithFileUploads;

    public $name;
    public $description;
    public $price;
    public $photo;
    public $newPhoto;
    public $stock;

    public function rules()
    {
        return (new ProductRequest())->rules();
    }

    public function updatedNewPhoto()
    {
        $this->validateOnly('newPhoto');
    }

    public function storeProduct (ProductService $productService)
    {
        $validated = $this->validate();

        try {
            $storeProductDto = ProductStoreDTO::fromRequest($validated);

            $product = $productService->create($storeProductDto);


        } catch (\Exception $e) {
            LivewireSwal::make($this)
                ->error()
                ->setParams([
                    'title' => 'Error',
                    'text' => 'An error occurred while creating the product',
                    'footer' => $e->getMessage()
                ])
                ->fireSwalEvent();
            return;
        }

        // Clear the form
        $this->reset([
            'name',
            'description',
            'price',
            'photo',
            'newPhoto',
            'stock'
        ]);

        LivewireSwal::make($this)
            ->success()
            ->setParams([
                'title' => trans('Success') . "!",
                'text' => trans('product') . ' created successfully',
                'footer' => trans('create_another_product')
            ])
            ->fireSwalEvent();

    }

    public function render()
    {
        return view('livewire.product-create');
    }
}
