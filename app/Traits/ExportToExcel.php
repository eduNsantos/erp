<?php

namespace App\Traits;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

trait ExportToExcel {
    private $items;

    public function getColumns()
    {
        return $this->columns;
    }
}