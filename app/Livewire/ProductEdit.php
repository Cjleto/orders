<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Arr;
use App\DTO\ProductUpdateDTO;
use App\Helpers\LivewireSwal;
use Livewire\Attributes\Lazy;
use Livewire\WithFileUploads;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;


class ProductEdit extends Component
{

    use WithFileUploads;

    public Product $product;

    public $newPhoto;

    public $name;
    public $description;
    public $price;
    public $photo;
    public $stock;

    public function mount ()
    {
        $this->name = $this->product->name;
        $this->description = (string) $this->product->description;
        $this->price = $this->product->price;
        $this->stock = $this->product->stock;

        $this->loadPhoto();
    }

    private function loadPhoto()
    {
        $this->photo = $this->product->getFirstMediaUrl('photo');
    }

    public function rules()
    {
        return (new ProductRequest($this->product->id))->rules();
    }

    public function updateProduct(ProductService $productService)
    {
        $validated = $this->validate();

        try {

            $updateProductDto = ProductUpdateDTO::fromRequest($validated,$this->product->id);

            $productService->update($updateProductDto);

            $this->loadPhoto();

            $this->reset([
                'newPhoto'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            $errorMessages = implode(', ', Arr::flatten($e->errors()));
            // Intercetta l'eccezione di validazione e mostra un messaggio con SweetAlert
            LivewireSwal::make($this)
                ->error()
                ->setParams([
                    'title' => 'Validation Error',
                    'text' => $errorMessages,
                    'footer' => trans('validation.validation_invitation'),
                ])
                ->fireSwalEvent();
            return;
        } catch (\Exception $e) {
            LivewireSwal::make($this)
                ->error()
                ->setParams([
                    'title' => 'Error',
                    'text' => trans('validation.product_update_error'),
                    'footer' => $e->getMessage()
                ])
                ->fireSwalEvent();
            return;
        }

        $this->dispatch('productUpdated');



        LivewireSwal::make($this)
            ->success()
            ->setParams([
                'title' => trans('success') . "!",
                'text' => trans('product') . ' ' . trans('updated_successfully'),
                'emit' => 'close-modal'
            ])
            ->fireSwalEvent();

    }

    public function render()
    {
        return view('livewire.product-edit');
    }
}
