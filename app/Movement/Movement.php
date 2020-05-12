<?php

namespace App\Movement;

abstract class Movement implements MovementType
{
    private $productId;
    private $quantity;
    private $movementReason;

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