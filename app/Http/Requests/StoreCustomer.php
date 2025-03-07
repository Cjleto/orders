<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
