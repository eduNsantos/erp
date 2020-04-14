<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    const IN_ANALYSIS = 1;
    const CLOSED = 2;
    const CANCELED = 3;

    protected $fillable = [
        'user_id',
        'client_id',
        'order_status_id',
    ];

    public function status()
    {
        return $this->hasOne(OrderStatus::class, 'id', 'order_status_id');
    }

    public function products()
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

    public function getTotalPriceAttribute()
    {
        $products = Product::whereHas('order_products', function (Builder $query) {
                $query->where('order_id', $this->id);
            })
            ->get()
        ;
        $quantities = OrderProduct::where('order_id', $this->id)->get();
        
        $total = 0;
        for ($i = 0; $i < count($products); $i++) {
            $total += $products[$i]->price * $quantities[$i]->quantity;
        }

        return 'R$ ' . number_format($total, 2, ',', '.');
    }
}
