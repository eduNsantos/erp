<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use App\ProductCategory;
use App\ProductGroup;
use App\ProductStatus;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ProductController extends Controller
{
    public function __construct()
    {
        $products = Product::with([
            'unit:id,name',
            'brand',
            'category',
            'group',
            'status'
        ])->get();

        $this->columns = [
            'code' => true,
            'name' => true,
            'description' => true,
            'category' => 'name',
            'unit' => 'name',
            'brand' => 'name',
            'group' => 'name'
        ];
        $this->items = $products;
    }

    /**
     * Export data to xlsx file
     * 
     */
    public function exportToExcel(array $columns, array $items, string $filePath)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        $columnCounter = 1;
        foreach ($columns as $column => $relationField) {
            $sheet->setCellValueByColumnAndRow($columnCounter, 1, Lang::trans("messages.stock.$column"))
                ->getStyleByColumnAndRow($columnCounter, 1)
                ->getFont()
                ->setBold(true)
                ->setSize(12)
            ;
            $columnCounter++;
        }

        $rowCounter = 2;
        foreach ($items as $item) {
            $column = 1;
            foreach ($item as $field) {
                if (is_array($field)) {
                    $sheet->setCellValueByColumnAndRow($column, $rowCounter, $field['name'])
                        ->getColumnDimensionByColumn($column)
                        ->setAutoSize(true)
                    ;
                } else {
                    $sheet->setCellValueByColumnAndRow($column, $rowCounter, $field)
                        ->getColumnDimensionByColumn($column)
                        ->setAutoSize(true)
                    ;
                }
                $column++;
            }
            $rowCounter++;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);
    }

    public function test()
    {
        $items = array_map(function ($item) {
            $newItem = [];
            foreach ($this->columns as $column => $relationField) {
                if ($relationField) {
                    $newItem[] = $item[$column];
                } else {
                    $newItem[] = $item[$column][$relationField];
                }
            }

            return $newItem;
        }, $this->items->toArray());

        $this->exportToExcel($this->columns, $items, base_path('public\\test.xlsx'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = $this->columns;
        $products = $this->items;

        return view('product.list', compact('columns', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = Unit::all();
        $brands = Brand::all();
        $categories = ProductCategory::all();
        $statuses = ProductStatus::all();
        $groups = ProductGroup::all();
        
        return view('product.register', compact('units', 'brands', 'categories', 'statuses', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            '*' => 'required'
        ]);

        if (!$validation) {
            return response($validation->errors());
        }

        $product = Product::create($request->all());

        return back()->with('message', 'Cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
