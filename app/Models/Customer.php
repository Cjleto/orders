<?php

namespace App\Models;

use App\Http\Traits\ClearCacheOnModelChange;
use App\Interfaces\HasIncludableRelations;
use App\Interfaces\HasSortableFields;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Customer extends Model implements HasIncludableRelations, HasSortableFields
{
    use HasFactory, LogsActivity, ClearCacheOnModelChange;

    protected $fillable = ['first_name', 'last_name', 'email', 'address', 'phone'];

    public function getSortableFields(): array
    {
        return ['id', 'first_name', 'last_name', 'created_at'];
    }

    public function getIncludableRelations(): array
    {
        return ['orders'];
    }

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
