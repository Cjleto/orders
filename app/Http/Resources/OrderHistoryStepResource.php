<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *   schema="OrderHistoryStepResource",
 *  title="Order History Step Resource",
 * description="Rappresentazione di uno step dello storico di un ordine",
 * @OA\Property(property="id", type="integer", example=1),
 * @OA\Property(property="order_id", type="integer", example=1),
 * @OA\Property(property="status", type="string", example="pending"),
 * @OA\Property(property="created_at", type="string", format="date-time", example="2021-10-01T00:00:00.000000Z"),
 * )
 */
class OrderHistoryStepResource extends JsonResource
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
            'order_id' => $this->order_id,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
