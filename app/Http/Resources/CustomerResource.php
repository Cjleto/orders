<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *   schema="CustomerResource",
 *  title="Customer Resource",
 * description="Rappresentazione di un cliente",
 * @OA\Property(property="id", type="integer", example=1),
 * @OA\Property(property="first_name", type="string", example="Mario"),
 * @OA\Property(property="last_name", type="string", example="Rossi"),
 * @OA\Property(property="email", type="string", example="adm@adm.com"),
 * @OA\Property(property="address", type="string", example="Via Roma 1"),
 * @OA\Property(property="phone", type="string", example="333#######"),
 * @OA\Property(
 *         property="orders",
 *         type="array",
 *         nullable=true,
 *         description="Il campo 'orders' viene incluso solo se la query string include=orders è presente.",
 *         @OA\Items(ref="#/components/schemas/OrderResource")
 *     ),
 * @OA\Property(property="created_at", type="string", format="date-time", example="2021-10-01T00:00:00.000000Z"),
 * @OA\Property(property="updated_at", type="string", format="date-time", example="2021-10-01T00:00:00.000000Z"),
 * )
 */
class CustomerResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'address' => $this->address,
            'phone' => $this->phone,
            'orders' => OrderResource::collection($this->whenLoaded('orders')),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
