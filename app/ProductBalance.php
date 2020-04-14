<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductBalance extends Model
{
    protected $fillable = ['product_id', 'product_balance_type_id', 'quantity'];
    protected $with = ['type'];

    public function type()
    {
        return $this->hasOne(ProductBalanceType::class, 'id', 'product_balance_type_id');
    }
    
    public function getAvailableBalance()
    {
        $available = self::where('product_id', $this->product_id)
            ->where('product_balance_type_id', ProductBalanceType::PHYSICAL)->first();
        $reserved = self::where('product_id', $this->product_id)
        ->where('product_balance_type_id', ProductBalanceType::RESERVED)->first();

        return $available->quantity - $reserved->quantity;
    }
    
    /**
     * Creates default quantities in the stock for a product
     * 
     * @param int $productId
     * @param int $quantity
     * @return void
     */
    public static function createDefaultProductBalance(int $productId, int $quantity = 0): void
    {
        self::create([
            'product_id' => $productId,
            'product_balance_type_id' => ProductBalanceType::PHYSICAL,
            'quantity' => $quantity
        ]);
        self::create([
            'product_id' => $productId,
            'product_balance_type_id' => ProductBalanceType::RESERVED,
            'quantity' => 0
        ]);
    }
}
