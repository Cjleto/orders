<?php

namespace App\Traits;

trait HasNameUcfirst
{
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }
}
