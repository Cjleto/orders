<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['first_name', 'last_name', 'email', 'address', 'phone'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }

    /** RELATIONSHIPS */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /** ACCESSORS */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }


}
