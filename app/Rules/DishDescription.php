<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DishDescription implements ValidationRule
{

    // da settare per far gestire il valore vuoto => https://laravel.com/docs/11.x/validation#implicit-rules
    public $implicit = true;

    public function __construct(private int $maxLength = 300, private int $minLength = 2)
    {
        $this->minLength = config('myconst.dish_min_length_description');
        $this->maxLength = config('myconst.dish_max_length_description');
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $canBeEmpty = config('myconst.dish_description_can_be_empty');
        $isString = is_string($value);
        $length = strlen(trim($value));

        if (!$canBeEmpty && is_null($value)) {
            $fail(__('The :attribute is required.'));
            return;
        }

        if (!$isString && !is_null($value)) {
            $fail(__('The :attribute must be a valid string.'));
            return;
        }

        if ($length > 0 && ($length < $this->minLength || $length > $this->maxLength)) {
            $fail(__('The :attribute must be between ' . $this->minLength . ' and ' . $this->maxLength . ' characters.'));
            return;
        }
    }
}
