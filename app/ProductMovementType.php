<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductMovementType extends Model
{
    public const RESERVATION_ENTRY = 1;
    public const RESERVATION_WITHDRAWAL = 2;
    public const PHYSICAL_ENTRY = 3;
    public const PHYSICAL_WITHDRAWAL = 4;
    protected $fillable = ['name'];

    public function movements()
    {
        return $this->hasMany(ProductMovement::class);
    }
}
