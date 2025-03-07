<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Rules\LivewireFileNameTooLong;
use Debugbar;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    public function __construct(private ?int $id = null)
    {}

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $rules = [
            'name' => [
                'required',
                'min:2',
                'max:55'
            ],
            'description' => 'required|min:2',
            'price' => 'required|numeric',
            'newPhoto' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048',
                new LivewireFileNameTooLong()
            ],
            'stock' => 'required|integer'
        ];

        if ($this->id) {
            $rules['name'][] = Rule::unique('products', 'name')->ignore($this->id);
        } else {
            $rules['name'][] = Rule::unique('products', 'name');
        }

        return $rules;
    }

    public function prepareForValidation()
    {
        if($this->hasFile('photo')) {
            $this->merge([
                'newPhoto' => $this['photo']
            ]);
        }

    }
}
