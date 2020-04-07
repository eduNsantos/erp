<?php

namespace App\Http\Controllers;

use App\ProductQuantity;

class StockController extends Controller
{
    public static function reservationIn($productId, $quantity, $reason)
    {
        ProductQuantity::where('product_id', $productId)
            ->where('type', ProductQuantity::RESERVED)
            ->increment($quantity);
    }

    public static function reservationOut($productId, $quantity, $reason)
    {
        ProductQuantity::where('product_id', $productId)
            ->where('type', ProductQuantity::RESERVED)
            ->decrement($quantity);
    }
    
    public static function stockIn($productId, $quantity, $reason)
    {
        ProductQuantity::where('product_id', $productId)
            ->where('type', ProductQuantity::REAL)
            ->increment($quantity);
    }
    
    public static function stockOut($productId, $quantity, $reason)
    {
        ProductQuantity::where('product_id', $productId)
            ->where('type', ProductQuantity::REAL)
            ->decrement($quantity);
    }

    private function hi()
    {

    }
}