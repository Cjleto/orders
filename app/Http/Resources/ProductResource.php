<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="ProductResource",
 *     title="Product Resource",
 *     description="Rappresentazione di un prodotto",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Pizza Margherita"),
 *     @OA\Property(property="price", type="number", format="float", example=9.99),
 *     @OA\Property(property="description", type="string", example="Deliziosa pizza con pomodoro e mozzarella"),
 *    @OA\Property(property="stock", type="integer", example=100),
 *   @OA\Property(property="is_in_stock", type="boolean", example=true),
 *    @OA\Property(property="photo", type="array", @OA\Items(
 *        @OA\Property(property="url", type="string", example="http://localhost:8000/storage/photo.jpg"),
 *       @OA\Property(property="name", type="string", example="photo.jpg"),
 *      @OA\Property(property="size", type="integer", example=1024),
 *     @OA\Property(property="mime_type", type="string", example="image/jpeg"),
 * )),
 *    @OA\Property(property="orders", type="array", @OA\Items(ref="#/components/schemas/OrderResource")),
 *   @OA\Property(property="created_at", type="string", format="date-time", example="2021-10-01T00:00:00.000000Z"),
 *  @OA\Property(property="updated_at", type="string", format="date-time", example="2021-10-01T00:00:00.000000Z"),
 * )
 * )
 */
class ProductResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'formatted_price' => $this->formatted_price,
            'stock' => $this->stock,
            'is_in_stock' => $this->is_in_stock,
            'photo' => $this->getMedia('photo')->map(function ($item) {
                return [
                    'url' => $item->getFullUrl(),
                    'name' => $item->name,
                    'size' => $item->size,
                    'mime_type' => $item->mime_type,
                ];
            }),
            'orders' => $this->whenLoaded('orders'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
