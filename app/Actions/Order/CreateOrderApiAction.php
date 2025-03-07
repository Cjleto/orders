<?php

namespace App\Actions\Order;

use App\DTO\OrderStoreApiDTO;
use App\DTO\OrderStoreDTO;
use App\Enums\OrderStatus;
use App\Events\OrderStatusChanged;
use App\Models\Order;
use App\Models\Product;
use App\Repositories\Contracts\OrderRepositoryContract;
use Illuminate\Support\Facades\DB;

/**
 * @property OrderRepository orderRepository
 */
class CreateOrderApiAction
{
    public function __construct(private OrderRepositoryContract $orderRepository) {}

    public function execute(OrderStoreApiDTO $orderStoreApiDTO): Order
    {

        return DB::transaction(function () use ($orderStoreApiDTO) {

            $products = Product::whereIn('id', array_column($orderStoreApiDTO->products, 'product_id'))->get();

            $total = 0;
            $orderItems = [];
            foreach ($orderStoreApiDTO->products as $item) {
                $currProduct = $products->where('id', $item['product_id'])->first();

                $orderItems[] = [
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'product_name' => $currProduct->name,
                    'product_price' => $currProduct->price,
                ];

                $total += $item['quantity'] * $currProduct->price;
            }

            $orderStoreDTO = new OrderStoreDTO(
                customer_id: $orderStoreApiDTO->customer_id,
                status: OrderStatus::IN_ELABORAZIONE->value,
                total: $total
            );

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
