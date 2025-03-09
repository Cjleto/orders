<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Cache;

trait ClearCacheOnModelChange
{
    protected static function bootClearCacheOnModelChange()
    {
        static::created(fn($model) => static::clearCache($model));
        static::updated(fn($model) => static::clearCache($model));
        static::deleted(fn($model) => static::clearCache($model));
    }

    protected static function clearCache($model)
    {
        $modelName = class_basename($model);
        $prefix = "model_data.{$modelName}.";

        if (config('cache.default') === 'database') {
            \DB::table('cache')->where('key', 'like', "{$prefix}%")->delete();
        } else {
            // Se è un altro driver (file, redis, etc.), usa forget()
            Cache::forget("{$prefix}*");
        }
    }
}
