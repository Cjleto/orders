<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Interfaces\HasIncludableRelations;
use Spatie\Activitylog\LogOptions;
use Database\Factories\OrderFactory;
use App\Interfaces\HasSortableFields;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;

#[UseFactory(OrderFactory::class)]
class Order extends Model implements HasSortableFields, HasIncludableRelations
{

    use HasFactory, HasUuids, LogsActivity;

    protected $fillable = ['customer_id', 'status', 'total'];

    /* protected $with = ['products','customer']; */

    public function getSortableFields(): array
    {
        return ['id', 'status', 'total', 'created_at'];
    }

    public function getIncludableRelations(): array
    {
        return ['products', 'customer'];
    }

    protected $casts = [
        'total' => 'float',
        'status' => OrderStatus::class
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }

    /** RELATIONSHIPS */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')
            ->withPivot(['quantity', 'product_name', 'product_price'])
            ->withTimestamps();
    }

    public function items ()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function historySteps ()
    {
        return $this->hasMany(OrderHistoryStep::class);
    }


    /** ACCESSORS */
    public function getFormattedTotalAttribute(): string
    {
        return number_format($this->total, 2, ',', '.') . ' ' . config('myconst.currency_symbol');
    }

    public function setTotalAttribute($value): void
    {
        $this->attributes['total'] = round($value, 2);
    }
}
