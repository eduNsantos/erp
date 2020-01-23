<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Interfaces\Excel;
use App\Product;
use App\ProductCategory;
use App\ProductGroup;
use App\ProductStatus;
use App\Traits\ExportToExcel;
use App\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller implements Excel
{
    use ExportToExcel;

    public function __construct()
    {
        $this->columns = ['Código', 'Nome', 'Descrição', 'Categoria', 'Unidade', 'Marca', 'Grupo do produto'];
        $this->items = Product::with([
            'unit',
            'brand',
            'category',
            'group',
            'status'
        ])->get();

        $this->setItems()
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

    public function test()
    {
        dd($this->exportToExcel());
    }
}
