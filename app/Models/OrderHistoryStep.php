<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderHistoryStep extends Model
{
    protected $table = 'order_history_steps';

    protected $fillable = ['order_id', 'status', 'user_id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
