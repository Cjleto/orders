<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_product';
    protected $fillable = ['order_id', 'product_id', 'quantity', 'product_name', 'product_price'];

    /** ACCESSORS */

    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->product_price, 2, ',', '.') . ' ' . config('myconst.currency_symbol');
    }

    /** RELATIONSHIPS */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
