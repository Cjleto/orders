<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *    schema="OrderProductResource",
 *  title="Order Product Resource",
 * description="Rappresentazione di un prodotto all'interno di un ordine",
 * @OA\Property(property="product_id", type="integer", example=1),
 * @OA\Property(property="product_name", type="string", example="Pizza Margherita"),
 * @OA\Property(property="product_price", type="number", format="float", example=9.99),
 * @OA\Property(property="quantity", type="integer", example=1),
 * )
 */
class OrderProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'product_id' => $this->product_id,
            'product_name' => $this->product_name,
            'product_price' => $this->product_price,
            'quantity' => $this->quantity,
        ];
    }
}
