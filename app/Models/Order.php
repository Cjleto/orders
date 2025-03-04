<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;

#[UseFactory(OrderFactory::class)]
class Order extends Model
{

    use HasFactory, HasUuids;

    protected $fillable = ['customer_id', 'status', 'total'];

    protected $casts = [
        'total' => 'float',
        'status' => OrderStatus::class
    ];

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
}
