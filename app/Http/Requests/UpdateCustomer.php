<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;


class UpdateCustomer extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('manage_users');
    }

    public function rules(): array
    {

        $rules = [
            'first_name' => [
                'required','min:2','max:55'
            ],
            'last_name' => [
                'required','min:2','max:55'
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('customers')->ignore($this->route('customer')->id)
            ],
            'address' => [
                'required','min:2','max:255'
            ],
            'phone' => [
                'required', 'regex:/^(?:\+39)?\s?(3[1-9]\d{8})$/'
            ],
        ];

        return $rules;
    }
}
