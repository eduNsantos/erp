<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductQuantity extends Model
{
    const CURRENT = 1;
    const RESERVED = 2;
    const AVAILABLE = 3;

    protected $fillable = ['product_id', 'type', 'quantity'];

    /**
     * Creates default quantities in the stock for a product
     * 
     * @param int $productId
     * @param int $quantity
     * @return void
     */
    public static function createDefaultProductQuantities(int $productId, int $quantity = 0): void
    {
        self::create([
            'product_id' => $productId,
            'type' => self::CURRENT,
            'quantity' => $quantity
        ]);
        self::create([
            'product_id' => $productId,
            'type' => self::RESERVED,
            'quantity' => 0
        ]);
        self::create([
            'product_id' => $productId,
            'type' => self::AVAILABLE,
            'quantity' => 0
        ]);
    }
}
