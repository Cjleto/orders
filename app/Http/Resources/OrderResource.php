<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
