<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Grid\Components\ExportExcel;
use App\Http\Controllers\Grid\Components\NewModel;
use App\Http\Controllers\Grid\GridController;
use App\ProductCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductCategoryController extends GridController
{
    const TRANSLATION_PREFIX = 'stock.product-category';

    public function __construct()
    {
        $this->columns = [
            'id' => true,
            'name' => true,
            'countProducts' => true,
        ];
        $this->items = ProductCategory::all();

        $this->addButton(new ExportExcel('product-category.exportToExcel'));
        $this->addButton(new NewModel('product-category.create'));

        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.category.register-category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:30'
        ]);

        $productCategory = ProductCategory::create($request->all());

        return new JsonResponse([
            'message' => "Categoria $productCategory->id criada com sucesso!",
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
