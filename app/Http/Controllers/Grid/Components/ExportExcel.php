<?php

namespace App\Http\Controllers\Grid\Components;

class ExportExcel extends Button
{
    public function __construct($action, $tooltip = "Exportar para excel")
    {
        parent::__construct($action, 'fas fa-file-excel', true, $tooltip, 'btn btn-success');
    }
}