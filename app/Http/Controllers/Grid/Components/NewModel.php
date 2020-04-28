<?php

namespace App\Http\Controllers\Grid\Components;

class NewModel extends Button
{
    public function __construct($action = '#', $tooltip = "Adicionar novo")
    {
        parent::__construct($action, 'fas fa-plus', true, $tooltip);
    }
}