<?php

namespace App\Http\Controllers;

use App\SessionDate;
use Illuminate\Support\Facades\Lang;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class GridController extends Controller
{
    /**
     * Export data to xlsx file
     * 
     */
    public function exportToExcel()
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet = $this->getExcelHeaders($spreadsheet, $this->columns);
        $spreadsheet = $this->getExcelContent($spreadsheet, $this->columns, $this->items);

        $sessionDate = new SessionDate();
        $fileName = $sessionDate->getInitialDateSeparetedBy('-') . ' à ' . $sessionDate->getFinalDateSeparetedBy('-');
        $fileName .= ' test';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. $fileName .'.xlsx"');

        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
    }

    public function getExcelHeaders(Spreadsheet $spreadsheet, array $columns)
    {
        $sheet = $spreadsheet->getActiveSheet();

        $columnCounter = 1;
        foreach ($columns as $column => $relationField) {
            $sheet->setCellValueByColumnAndRow($columnCounter, 1, Lang::trans("messages.stock.$column"))
                ->getStyleByColumnAndRow($columnCounter, 1)
                ->getFont()
                ->setBold(true)
                ->setSize(12)
                ->getActiveCell()
            ;
            $columnCounter++;
        }

        return $spreadsheet;
    }

    public function getExcelContent(Spreadsheet $spreadsheet, $columns, $items)
    {
        $sheet = $spreadsheet->getActiveSheet();
        $rowCounter = 2;
        foreach ($items as $item) {
            $columnCounter = 1;
            foreach ($columns as $column => $relationField) {
                $cell = $relationField === true ? $item->{$column} : $item->{$column}->{$relationField};
                $sheet->setCellValueByColumnAndRow($columnCounter, $rowCounter, $cell)
                    ->getColumnDimensionByColumn($columnCounter)
                    ->setAutoSize(true)
                ;
                $columnCounter++;
            }
            $rowCounter++;
        }

        return $spreadsheet;
    }
}
