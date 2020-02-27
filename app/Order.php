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

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTotalAttribute()
    {
        $orderProduct = OrderProduct::where('order_id', $this->id)
            ->sum('quantity')
        ;

        return $orderProduct;
    }
}
