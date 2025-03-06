<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\OrderRepositoryContract;

/**
 * @property OrderRepository orderRepository
 */
class OrderService
{
    public function __construct(
        protected OrderRepositoryContract $orderRepository,
    ){}

    public function all(): Collection
    {
        return $this->orderRepository->findAll();
    }

    public function store (array $data): Order
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

    public function delete(int $id): bool|null
    {
        return $this->orderRepository->delete($id);
    }

    public function getOrdersBetweenDates(string $start, string $end): Collection
    {
        return $this->orderRepository->getOrdersBetweenDates($start, $end);
    }


}
