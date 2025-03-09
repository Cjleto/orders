<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Exceptions\CustomException;
use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryContract;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

/**
 * @property OrderRepository orderRepository
 */
class OrderService
{
    public function __construct(
        protected OrderRepositoryContract $orderRepository,
    ) {}

    public function all(): Collection
    {
        return $this->orderRepository->findAll();
    }

    public function store(array $data): Order
    {

        $order = $this->orderRepository->create($data);

        return $order;

    }

    public function update(array $data, int $id): Order
    {

        $order = $this->orderRepository->find($id);

        $order->update($data);

        return $order;

    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->orderRepository->paginate($perPage);
    }

    public function delete(string $id): ?bool
    {
        return $this->orderRepository->delete($id);
    }

    public function getOrdersBetweenDates(string $start, string $end): Collection
    {
        return $this->orderRepository->getOrdersBetweenDates($start, $end);
    }

    public function getOrderIndexData(array $searchData, array $relations = []): LengthAwarePaginator
    {
        return $this->orderRepository->getOrderIndexData($searchData, $relations);
    }

    public function getWithRelations(?int $perPage = null): Collection|Paginator
    {
        return $this->orderRepository->getWithRelations(['customer', 'products'], $perPage);
    }

    public function getWithSortingAndIncludes(?int $perPage = null): Collection|Paginator
    {
        return $this->orderRepository->getWithSortingAndIncludes();
    }

    public function isCompleted(Order $order): bool
    {
        return $order->status == OrderStatus::CONSEGNATO;
    }

    public function storeOrderItems (Order $order, Collection $orderItems): void
    {

        if($this->isCompleted($order)) {
            throw new CustomException('Order is already completed and cannot be updated');
        }

        foreach ($orderItems as $item) {
            $order->products()->attach($item['product_id'], [
                'quantity' => $item['quantity'],
                'product_name' => $item['product_name'],
                'product_price' => $item['product_price'],
            ]);

            $product = $order->products()->find($item['product_id']);
            $product->stock -= $item['quantity'];
            $product->save();

        }

    }

    public function calculateTotal(Order $order): void
    {
        $total = $order->products->sum(function ($product) {
            return $product->pivot->quantity * $product->pivot->product_price;
        });

        $order->total = $total;
        $order->save();
    }

}
