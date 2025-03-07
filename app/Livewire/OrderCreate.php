<?php

namespace App\Livewire;

use App\Actions\Order\CreateOrderAction;
use App\DTO\OrderProductDTO;
use App\DTO\OrderStoreDTO;
use App\Enums\OrderStatus;
use App\Helpers\LivewireSwal;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Product;
use App\Repositories\Contracts\CustomerRepositoryContract;
use App\Repositories\Contracts\ProductRepositoryContract;
use Debugbar;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class OrderCreate extends Component
{
    public Collection $products;

    public Collection $customers;

    public Collection $orderItems;

    public string $searchProduct = '';

    public bool $showSaveButton = false;

    public float $total = 0;

    public string $status = OrderStatus::IN_ELABORAZIONE->value;

    public int $customer_id = 0;

    public int $selectedProductId = 0;

    public Product $selectedProduct;

    public $createdOrder;

    public function rules()
    {
        return (new StoreOrderRequest)->rules();
    }

    public function mount()
    {
        $this->loadCustomers();
        $this->orderItems = collect();
        $this->dispatch('searchProductUpdated', '');
    }

    public function setShowButton()
    {
        Debugbar::info('cus: '.$this->customer_id);
        $this->showSaveButton = false;
        if ($this->orderItems->count() > 0 && $this->customer_id > 0) {
            $this->showSaveButton = true;
        }
    }

    public function loadProducts(string $value)
    {
        /** @var productRepository $productRepository */
        $productRepository = app(ProductRepositoryContract::class);
        $this->products = $productRepository->searchByFieldPaginated(
            field: 'name',
            search: $value
        );

        Debugbar::info($this->products);

    }

    public function loadCustomers()
    {
        /** @var CustomerRepository $customerRepository */
        $customerRepository = app(CustomerRepositoryContract::class);
        $this->customers = $customerRepository->findAll();

    }

    public function updatedSearchProduct(string $value)
    {
        $this->dispatch('searchProductUpdated', $value);
    }

    #[On('productAdded')]
    public function addOrderItem(Product $product)
    {
        try {
            $this->__checkQuantity($product);
            $this->addProduct($product);
            $this->showSaveButton = true;
        } catch (\Exception $e) {
            LivewireSwal::make($this)
                ->error()
                ->toast()
                ->setParams([
                    'title' => 'Error',
                    'text' => 'An error occurred while creating the order',
                    'footer' => $e->getMessage(),
                ])
                ->fireSwalEvent();

            return;
        }

    }

    public function addProduct(Product $product)
    {
        $existingItemKey = $this->orderItems->search(function ($item) use ($product) {
            return $item['product_id'] === $product->id;
        });

        if ($existingItemKey !== false) {
            $this->__increaseQuantity($existingItemKey);

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

    private function __checkQuantity(Product $product)
    {
        $existingItemKey = $this->orderItems->search(function ($item) use ($product) {
            return $item['product_id'] === $product->id;
        });

        if ($existingItemKey !== false) {
            if ($this->orderItems[$existingItemKey]['quantity'] >= $product->stock) {
                throw new \Exception('Product quantity is not enough');
            }
        }
    }

    #[On('productRemoved')]
    public function removeOrderItem(Product $product)
    {
        $existingItemKey = $this->orderItems->search(function ($item) use ($product) {
            return $item['product_id'] === $product->id;
        });

        if ($existingItemKey !== false) {
            $this->__decreaseQuantity($existingItemKey);

            if ($this->orderItems[$existingItemKey]['quantity'] <= 0) {
                $this->orderItems->forget($existingItemKey);
            }
        }

        Debugbar::info($this->orderItems);
    }

    private function __increaseQuantity(int $existingItemKey)
    {
        $this->orderItems = $this->orderItems->transform(function ($item, $key) use ($existingItemKey) {
            if ($key === $existingItemKey) {
                $item['quantity']++;
            }

            return $item;
        });
    }

    private function __decreaseQuantity(int $existingItemKey)
    {
        $this->orderItems = $this->orderItems->transform(function ($item, $key) use ($existingItemKey) {
            if ($key === $existingItemKey) {
                $item['quantity']--;
            }

            return $item;
        });
    }

    #[Computed()]
    public function setTotal()
    {
        $this->total = $this->orderItems->sum(function ($item) {
            return $item['quantity'] * $item['product_price'];
        });
    }

    public function saveOrder(CreateOrderAction $createOrderAction)
    {

        try {
            $validated = $this->validate();
            $orderStoreDTO = new OrderStoreDTO(
                customer_id: $this->customer_id,
                total: $this->total,
                status: $this->status
            );

            $order = $createOrderAction->execute($orderStoreDTO, $this->orderItems);
            $this->createdOrder = $order;

            LivewireSwal::make($this)
                ->success()
                ->setParams([
                    'title' => 'Success',
                    'text' => 'Order created successfully',
                    'footer' => 'Order ID: '.$order->id,
                    'emit' => 'redirectConfirmed',
                ])
                ->fireSwalEvent();

            $this->reset([
                'customer_id',
                'status',
                'total',
                'showSaveButton',
            ]);

            $this->orderItems = collect();

        } catch (\Exception $e) {
            LivewireSwal::make($this)
                ->error()
                ->toast()
                ->setParams([
                    'title' => 'Error',
                    'text' => 'An error occurred while creating the order',
                    'footer' => $e->getMessage(),
                ])
                ->fireSwalEvent();

            return;
        }
    }

    public function redirectConfirmed()
    {
        return redirect()->route('orders.show', ['order' => $this->createdOrder->id]);
    }

    public function render()
    {
        $this->setTotal();
        $this->setShowButton();
        Debugbar::info($this->orderItems);

        return view('livewire.order-create');
    }
}
