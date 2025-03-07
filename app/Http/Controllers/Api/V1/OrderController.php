<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Order;
use App\DTO\OrderStoreDTO;
use Illuminate\Http\Request;
use App\DTO\OrderStoreApiDTO;
use App\Services\OrderService;
use App\Http\Resources\OrderResource;
use App\Http\Controllers\ApiController;
use App\Actions\Order\CreateOrderAction;
use App\Http\Requests\StoreOrderRequest;
use App\Actions\Order\CreateOrderApiAction;
use App\Http\Requests\StoreOrderApiRequest;

class OrderController extends ApiController
{
    public function __construct(
        protected OrderService $orderService
    ) {}

    public function index()
    {
        $orders = $this->orderService->getWithSortingAndIncludes();
        return OrderResource::collection($orders);
    }

    public function store(StoreOrderApiRequest $request, CreateOrderApiAction $createOrderApiAction)
    {
        $validated = $request->validated();
        $dto = OrderStoreApiDTO::fromRequest($validated);


        $order = $createOrderApiAction->execute($dto);
        return $this->success(new OrderResource($order), 201);
    }

    public function show(Request $request, Order $order)
    {

        $order = $this->loadIncludes($request, $order);

        return new OrderResource($order);
    }

    public function destroy(string $id)
    {
        $this->orderService->delete($id);
        return $this->success();
    }
}
