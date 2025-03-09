<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Order\CreateOrderApiAction;
use App\DTO\OrderStoreApiDTO;
use App\Http\Controllers\ApiController;
use App\Http\Requests\StoreOrderApiRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends ApiController
{
    public function __construct(
        protected OrderService $orderService
    ) {}

    /**
     * @see OpenApiOrder::index()
     */
    public function index()
    {
        $orders = $this->orderService->getWithSortingAndIncludes();

        return OrderResource::collection($orders);
    }

    /**
     * @see OpenApiOrder::store()
     */
    public function store(StoreOrderApiRequest $request, CreateOrderApiAction $createOrderApiAction)
    {
        $validated = $request->validated();
        $dto = OrderStoreApiDTO::fromRequest($validated);

        $order = $createOrderApiAction->execute($dto);

        return $this->success(new OrderResource($order), 201);
    }

    /**
     * @see OpenApiOrder::show()
     */
    public function show(Request $request, Order $order)
    {

        $order = $this->loadIncludes($request, $order);

        return new OrderResource($order);
    }

    /**
     * @see OpenApiOrder::destroy()
     */
    public function destroy(string $id)
    {
        $this->orderService->delete($id);

        return $this->success();
    }
}
