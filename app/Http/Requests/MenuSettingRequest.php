<?php

namespace App\Http\Requests;

use App\Enums\FontFamilyEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuSettingRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'primary_color' => [
                'required',
                'hex_color'
            ],
            'secondary_color' =>
            [
                'required',
                'hex_color'
            ],
            'tertiary_color' => [
                'required',
                'hex_color'
            ],
            'quaternary_color' => [
                'required',
                'hex_color'
            ],
            /* 'newMenuWallpaper' => [
                'nullable',
                'image'
            ],
            'backgroundOpacity' => [
                'required',
                'numeric',
                'between:0,1'
            ], */
            'title' => [
                'required',
                'string',
                'max:100'
            ],
            'template' => [
                'required',
                'string',
                'in:template1,template2,template3,template4,templatebistrot',
            ],
            'selectedFont' => [
                'required',
                Rule::in(FontFamilyEnum::cases())
            ],
            'selectedFontSecondary' => [
                'required',
                Rule::in(FontFamilyEnum::cases())
            ],
            'textFooter' => [
                'nullable',
                'string',
                'max:255'
            ],
            'background_color' => [
                'nullable',
                'hex_color'
            ]
        ];
    }
}
