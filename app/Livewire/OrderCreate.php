<?php

namespace App\Livewire;

use Debugbar;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
use App\DTO\OrderProductDTO;
use App\Helpers\LivewireSwal;
use Livewire\Attributes\Computed;
use Illuminate\Support\Collection;
use App\Repositories\Contracts\OrderRepositoryContract;
use App\Repositories\Contracts\ProductRepositoryContract;
use App\Repositories\Contracts\CustomerRepositoryContract;

class OrderCreate extends Component
{

    public Collection $products;
    public Collection $customers;
    public Collection $orderItems;
    public string $searchProduct = '';
    public bool $showSaveButton = false;

    public int $customerId;
    public int $selectedProductId = 0;
    public Product $selectedProduct;

    public function mount ()
    {
        $this->loadCustomers();
        $this->orderItems = collect();
        $this->dispatch('searchProductUpdated', '');
    }

    public function loadProducts (string $value)
    {
        /** @var productRepository $productRepository */
        $productRepository = app(ProductRepositoryContract::class);
        $this->products = $productRepository->searchByFieldPaginated(
            field: 'name',
            search: $value
        );

        Debugbar::info($this->products);

    }

    public function loadCustomers ()
    {
        /** @var CustomerRepository $customerRepository */
        $customerRepository = app(CustomerRepositoryContract::class);
        $this->customers = $customerRepository->findAll();

    }

    public function updatedSearchProduct (string $value)
    {
        $this->dispatch('searchProductUpdated', $value);
    }

    #[On('productAdded')]
    public function addOrderItem (Product $product)
    {
       try {
            $this->checkQuantity($product);
            $this->addProduct($product);
            $this->showSaveButton = true;
        } catch (\Exception $e) {
            $this->showSaveButton = false;
            LivewireSwal::make($this)
                ->error()
                ->toast()
                ->setParams([
                    'title' => 'Error',
                    'text' => 'An error occurred while creating the order',
                    'footer' => $e->getMessage()
                ])
                ->fireSwalEvent();
            return;
        }

    }

    public function addProduct (Product $product)
    {
        $existingItemKey = $this->orderItems->search(function ($item) use ($product) {
            return $item['product_id'] === $product->id;
        });

        if ($existingItemKey !== false) {
            $this->increaseQuantity($existingItemKey);
            return;
        }

        $item = new OrderProductDTO(
            product_id: $product->id,
            product_name: $product->name,
            quantity: 1,
            product_price: $product->price
        );

        $this->orderItems[] = $item->toArray();
    }

    private function checkQuantity(Product $product)
    {
        $existingItemKey = $this->orderItems->search(function ($item) use ($product) {
            return $item['product_id'] === $product->id;
        });

        if ($existingItemKey !== false) {
            if($this->orderItems[$existingItemKey]['quantity'] >= $product->stock) {
                throw new \Exception('Product quantity is not enough');
            }
        }
    }

    #[On('productRemoved')]
    public function removeOrderItem (Product $product)
    {
        $existingItemKey = $this->orderItems->search(function ($item) use ($product) {
            return $item['product_id'] === $product->id;
        });

        if ($existingItemKey !== false) {
            $this->decreaseQuantity($existingItemKey);

            if ($this->orderItems[$existingItemKey]['quantity'] <= 0) {
                $this->orderItems->forget($existingItemKey);
            }
        }

        Debugbar::info($this->orderItems);
    }

    private function increaseQuantity (int $existingItemKey)
    {
        $this->orderItems = $this->orderItems->transform(function ($item, $key) use ($existingItemKey) {
            if ($key === $existingItemKey) {
                $item['quantity']++;
            }
            return $item;
        });
    }


    private function decreaseQuantity(int $existingItemKey)
    {
        $this->orderItems = $this->orderItems->transform(function ($item, $key) use ($existingItemKey) {
            if ($key === $existingItemKey) {
                $item['quantity']--;
            }
            return $item;
        });
    }

    #[Computed()]
    public function total()
    {
        return $this->orderItems->sum(function ($item) {
            return $item['quantity'] * $item['product_price'];
        });
    }

    public function render()
    {
        Debugbar::info($this->orderItems);
        return view('livewire.order-create');
    }
}
