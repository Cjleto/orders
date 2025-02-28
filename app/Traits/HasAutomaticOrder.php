<?php

namespace App\Traits;

use Log;

trait HasAutomaticOrder
{
    protected static function bootHasAutomaticOrder()
    {
        /* dd('Trait eseguito'); */
        static::creating(function ($model) {
            if(is_null($model->order)){

                $model->order = $model->getMaxOrder() + 1;
            }
        });
    }
}
