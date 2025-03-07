<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class StoreUser extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::user()->hasPermissionTo('manage_users');
    }

    public function rules(): array
    {

        return [
            'name' => [
                'required', 'min:2', 'max:55',
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],
            'password' => [
                'required',
                Password::defaults(),
            ],
            'role' => [
                'required',
                Rule::in(Role::pluck('name')->toArray()),
            ],
        ];
    }
}
