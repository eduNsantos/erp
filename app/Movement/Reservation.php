<?php

namespace App\Movement;

use App\ProductBalance;
use App\ProductBalanceType;
use App\ProductMovement;
use App\ProductMovementType;
use Illuminate\Support\Facades\Auth;

class Reservation extends Movement
{
    public function withdrawal(): void
    {
        ProductMovement::create([
            'user_id' => Auth::user()->id,
            'product_movement_type_id' => ProductMovementType::RESERVATION_WITHDRAWAL,
            'product_id' => $this->getProductId(),
            'quantity' => $this->getQuantity(),
            'reason' => $this->getMovementReason()
        ]);

        ProductBalance::where('product_id', $this->getProductId())
            ->where('product_balance_type_id', ProductBalanceType::RESERVED)
            ->decrement('quantity', $this->getQuantity())
        ;
    }

    public function entry(): void
    {
        ProductMovement::create([
            'user_id' => Auth::user()->id,
            'product_movement_type_id' => ProductMovementType::RESERVATION_ENTRY,
            'product_id' => $this->getProductId(),
            'quantity' => $this->getQuantity(),
            'reason' => $this->getMovementReason()
        ]);

        ProductBalance::where('product_id', $this->getProductId())
            ->where('product_balance_type_id', ProductBalanceType::RESERVED)
            ->increment('quantity', $this->getQuantity())
        ;
    }
}