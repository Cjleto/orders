<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
