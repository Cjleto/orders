<?php

namespace App\Actions\Order;

use App\DTO\OrderStoreDTO;
use App\Events\OrderStatusChanged;
use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryContract;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * @property OrderRepository orderRepository
 */
class CreateOrderAction
{
    public function __construct(private OrderRepositoryContract $orderRepository) {}

    public function execute(OrderStoreDTO $orderStoreDTO, Collection $orderItems): Order
    {

        return DB::transaction(function () use ($orderStoreDTO, $orderItems) {
            $order = $this->orderRepository->create($orderStoreDTO->toArray());

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

            OrderStatusChanged::dispatch($order);

            return $order;
        });
    }
}
