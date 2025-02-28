<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:2|max:55',
            'description' => 'nullable|min:2|max:255',
            'address' => 'required|min:2|max:255',
            'logo' => 'required|image',
            'slug' => 'required|min:2|max:55|unique:companies,slug',
        ];
    }
}
