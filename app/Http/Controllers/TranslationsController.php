<?php

namespace App\Http\Controllers;

use App\Enums\LanguageEnum;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class TranslationsController extends Controller
{
    public function show (Model $model, int $id )
    {

        $translations = [];

        $model = $model::findOrFail($id);

        $availableLanguages = LanguageEnum::cases();
        $translablableFields = $model->getTranslatableFields();
        foreach ($availableLanguages as $lang) {
            foreach ($translablableFields as $field) {

                $translations[$lang->value][$field] = $this->model->getTranslatedValue($field, $lang->value) ?? '';
                $this->enableTranslateButton[$lang->value][$field] = !$this->model->translationExists($field, $lang->value);
            }
        }
    }
}
