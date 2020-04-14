<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductBalanceType extends Model
{
    const PHYSICAL = 1;
    const RESERVED = 2;
    const AVAILABLE = 3;

    public function balances()
    {
        return $this->hasMany(ProductBalance::class);
    }
}
