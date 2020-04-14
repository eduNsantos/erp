<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductBalance;
use App\ProductBalanceType;
use App\ProductMovement;
use App\ProductMovementType;
use App\User;
use Illuminate\Support\Facades\Auth;

class MovementController extends Controller
{
    private $productId;
    private $quantity;
    private $movementReason;
    

    public function reservationEntry()
    {
        ProductMovement::create([
            'user_id' => Auth::user()->id,
            'product_movement_type_id' => ProductMovementType::RESERVATION_ENTRY,
            'product_id' => $this->getProductId(),
            'quantity' => $this->getQuantity(),
            'reason' => $this->getMovementReason()
        ]);

        return ProductBalance::where('product_id', $this->getProductId())
            ->where('product_balance_type_id', ProductBalanceType::RESERVED)
            ->increment('quantity', $this->getQuantity())
        ;
    }

    public function reservationWithdrawal()
    {
        ProductMovement::create([
            'user_id' => Auth::user()->id,
            'product_movement_type_id' => ProductMovementType::RESERVATION_WITHDRAWAL,
            'product_id' => $this->getProductId(),
            'quantity' => $this->getQuantity(),
            'reason' => $this->getMovementReason()
        ]);

        return ProductBalance::where('product_id', $this->getProductId())
            ->where('product_balance_type_id', ProductBalanceType::RESERVED)
            ->decrement('quantity', $this->getQuantity())
        ;
    } 

    /**
     * Get the value of productId
     */ 
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set the value of productId
     *
     * @return  self
     */ 
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get the value of quantity
     */ 
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */ 
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of movementReason
     */ 
    public function getMovementReason()
    {
        return $this->movementReason;
    }

    /**
     * Set the value of movementReason
     *
     * @return  self
     */ 
    public function setMovementReason($movementReason)
    {
        $this->movementReason = $movementReason;

        return $this;
    }
}