<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductMovement extends Model
{
    protected $fillable = ['user_id', 'product_movement_type_id', 'product_id', 'quantity', 'reason'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function type()
    {
        return $this->hasOne(ProductMovementType::class);
    }
}
