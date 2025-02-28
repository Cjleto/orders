<?php

namespace App\Models;

use App\Enums\LanguageEnum;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivityWithImpersonation;

class Translation extends Model
{
    use LogsActivityWithImpersonation;

    protected $fillable = ['translatable_id', 'translatable_type', 'locale', 'field', 'value'];

    protected $casts = [
        'locale' => LanguageEnum::class,
    ];

    public function translatable()
    {
        return $this->morphTo();
    }
}
