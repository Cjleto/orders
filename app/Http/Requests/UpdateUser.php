<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;


class UpdateUser extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
            'role' => [
                'required',
                Rule::in(Role::pluck('name')->toArray())
            ],
            'password' => ['nullable', Password::defaults()],
        ];
    }
}
