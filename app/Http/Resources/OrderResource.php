<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *    schema="OrderResource",
 *   title="Order Resource",
 *  description="Rappresentazione di un ordine",
 * @OA\Property(property="id", type="integer", example=1),
 * @OA\Property(property="customer", ref="#/components/schemas/CustomerResource"),
 * @OA\Property(property="products", type="array", @OA\Items(ref="#/components/schemas/ProductResource")),
 * @OA\Property(property="items", type="array", @OA\Items(ref="#/components/schemas/OrderProductResource")),
 * @OA\Property(property="history_steps", type="array", @OA\Items(ref="#/components/schemas/OrderHistoryStepResource")),
 * @OA\Property(property="status", type="string", example="in_elaborazione"),
 * @OA\Property(property="total", type="number", format="float", example=9.99),
 * @OA\Property(property="formatted_total", type="string", example="€ 9,99"),
 * @OA\Property(property="created_at", type="string", format="date-time", example="2021-10-01T00:00:00.000000Z"),
 * @OA\Property(property="updated_at", type="string", format="date-time", example="2021-10-01T00:00:00.000000Z"),
 * )
 *
 */
class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customer' => new CustomerResource($this->whenLoaded('customer')),
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'items' => OrderProductResource::collection($this->whenLoaded('items')),
            'history_steps' => OrderHistoryStepResource::collection($this->whenLoaded('historySteps')),
            'status' => $this->status->value, // Enum
            'total' => $this->total,
            'formatted_total' => $this->formatted_total,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
