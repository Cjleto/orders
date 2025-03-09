<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


/**
 * @OA\Schema(
 *     schema="StoreOrderApiRequest",
 *     type="object",
 *     title="Store Order Request",
 *     description="Request body per la creazione di un nuovo ordine",
 *     required={"customer_id", "products"},
 *     @OA\Property(
 *         property="customer_id",
 *         type="integer",
 *         description="ID del cliente che effettua l'ordine",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="products",
 *         type="array",
 *         description="Lista dei prodotti nell'ordine",
 *         @OA\Items(
 *             type="object",
 *             required={"product_id", "quantity"},
 *             @OA\Property(
 *                 property="product_id",
 *                 type="integer",
 *                 description="ID del prodotto da acquistare",
 *                 example=10
 *             ),
 *             @OA\Property(
 *                 property="quantity",
 *                 type="integer",
 *                 description="Quantità del prodotto",
 *                 minimum=1,
 *                 example=2
 *             )
 *         )
 *     )
 * )
 */
class StoreOrderApiRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ];
    }
}
