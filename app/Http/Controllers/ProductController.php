<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\ProductCategory;
use App\ProductGroup;
use App\ProductQuantity;
use App\ProductStatus;
use App\Unit;
use Illuminate\Http\Request;

class ProductController extends GridController
{
    const TRANSLATION_PREFIX = "stock";
    public function __construct()
    {        
        $this->columns = [
            'id' => true,
            'code' => true,
            'name' => true,
            'description' => true,
            'category' => 'name',
            'unit' => 'initials',
            'multiple' => true,
            'brand' => 'initials',
            'group' => 'name',
            'status' => 'name',
            'created_at' => true,
            'updated_at' => true
        ];
        $this->items = Product::with([
            'unit',
            'brand',
            'category',
            'group',
            'status'
        ])->get();
    }

    /**
     * Method to export data to excel
     */
    public function exportToExcel()
    {
        return parent::_exportToExcel('Listagem de produtos');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = $this->columns;
        $items = $this->items;

        return view('list', compact('columns', 'items'));
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
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->all());
        
        ProductQuantity::createDefaultProductQuantities($product->id);

        return response()->json([
            'message' => 'Produto cadastrado com sucesso!',
            'type' => 'success'
        ]);
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
