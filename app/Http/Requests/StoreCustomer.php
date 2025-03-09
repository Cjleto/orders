<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Schema(
 *     schema="StoreCustomer",
 *     type="object",
 *     title="Store Customer Request",
 *     required={"first_name", "last_name", "email", "address", "phone"},
 *     @OA\Property(
 *         property="first_name",
 *         type="string",
 *         description="First name of the customer",
 *         example="John"
 *     ),
 *     @OA\Property(
 *         property="last_name",
 *         type="string",
 *         description="Last name of the customer",
 *         example="Doe"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         format="email",
 *         description="Email address of the customer",
 *         example="john.doe@example.com"
 *     ),
 *     @OA\Property(
 *         property="address",
 *         type="string",
 *         description="Address of the customer",
 *         example="123 Main St, Anytown, USA"
 *     ),
 *     @OA\Property(
 *         property="phone",
 *         type="string",
 *         description="Phone number of the customer",
 *         example="+393331234567"
 *     )
 * )
 */
class StoreCustomer extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('manage_users');
    }

    public function rules(): array
    {

        return [
            'first_name' => [
                'required', 'min:2', 'max:55',
            ],
            'last_name' => [
                'required', 'min:2', 'max:55',
            ],
            'email' => [
                'required',
                'email',
                'unique:customers,email',
            ],
            'address' => [
                'required', 'min:2', 'max:255',
            ],
            'phone' => [
                'required', 'regex:/^(?:\+39)?\s?(3[1-9]\d{8})$/',
            ],
        ];
    }
}
