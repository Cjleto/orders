<?php

namespace App\Actions\Order;

use App\DTO\OrderStoreDTO;
use App\Events\OrderStatusChanged;
use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryContract;
use App\Services\OrderService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CreateOrderAction
{
    public function __construct(private OrderService $orderService) {}

    public function execute(OrderStoreDTO $orderStoreDTO, Collection $orderItems): Order
    {

        return DB::transaction(function () use ($orderStoreDTO, $orderItems) {
            $order = $this->orderService->store($orderStoreDTO->toArray());

            $this->orderService->storeOrderItems($order, $orderItems);

            OrderStatusChanged::dispatch($order);

            return $order;
        });
    }
}
