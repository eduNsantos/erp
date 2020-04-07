<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductQuantity extends Model
{
    const REAL = 1;
    const RESERVED = 2;
    const AVAILABLE = 3;

    protected $fillable = ['product_id', 'type', 'quantity'];

    public static function getQuantityStatusName($id)
    {
        switch ($id) {
            case 1:
                return 'Físico atual';
                break;    
            case 1:
                return 'Reservado';
                break;
        
            case 1:
                return 'Disponível';
                break;
        }
    }
    
    public function getAvailableBalance()
    {
        $available = self::where('product_id', $this->product_id)
            ->where('type', self::REAL)->first();
        $reserved = self::where('product_id', $this->product_id)
        ->where('type', self::RESERVED)->first();

        return $available->quantity - $reserved->quantity;
    }
    
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
            'type' => self::REAL,
            'quantity' => $quantity
        ]);
        self::create([
            'product_id' => $productId,
            'type' => self::RESERVED,
            'quantity' => 0
        ]);
    }
}
