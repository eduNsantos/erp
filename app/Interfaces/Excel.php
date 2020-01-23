<?php

namespace App\Interfaces;

interface Excel {
    public function getItems();
    public function getColumns();
    public function exportToExcel();
}