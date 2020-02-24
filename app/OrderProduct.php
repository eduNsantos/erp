<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = [
        'product_id',
        'quantity'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
