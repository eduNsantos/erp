<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Http\Controllers\Grid\Components\NewModel;
use App\Http\Controllers\Grid\GridController;
use Illuminate\Http\Request;

class BrandController extends GridController
{
    const TRANSLATION_PREFIX = 'stock.product.brand';

    public function __construct()
    {
        $this->items = Brand::all();
        $this->columns = [
            'id' => true,
            'name' => true,
            'initials' => true,
            'is_active' => true,
            'countProducts' => true,
        ];
        $this->addButton(new NewModel('brand.create'));
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
        return view('product.brand.register-brand');
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
            'name' => 'required|max:30|unique:brands,name',
            'initials' => 'required|max:7|unique:brands,initials'
        ]);

        $brand = Brand::create($request->all());

        return response()->json([
            'message' => 'Marca de produto '. $brand->id . ' cadastrado com sucesso!',
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
