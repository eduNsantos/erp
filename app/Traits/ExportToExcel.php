<?php

namespace App\Traits;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

trait ExportToExcel {
    public function exportToExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Código');

        $writer = new Xlsx($spreadsheet);
        $writer->save(base_path('\\public\\test.xlsx'));
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items)
    {
        return $this->items = $items;
    }

    public function getColumns()
    {
        return $this->columns;
    }
}