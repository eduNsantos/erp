<?php

namespace App\Movement;

interface MovementType
{
    public function withdrawal(): void;
    public function entry(): void;
}