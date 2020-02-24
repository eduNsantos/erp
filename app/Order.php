<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const ACTIVE = 1;
    const CLOSED = 2;
    const CANCELED = 3;

    protected $fillable = [
        'user_id',
        'client_id',
        'status',
    ];

    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
