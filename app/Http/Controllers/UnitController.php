<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Grid\Components\ExportExcel;
use App\Http\Controllers\Grid\Components\NewModel;
use App\Http\Controllers\Grid\GridController;
use App\Unit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UnitController extends GridController
{
    const TRANSLATION_PREFIX = 'stock.product-unit';

    public function __construct()
    {
        $this->columns = [
            'id' => true,
            'name' => true,
            'initials' => true,
            'created_at' => true,
            'updated_at' => true,
        ];
        $this->items = Unit::all();
        $this->addButton(new ExportExcel('product-unit.exportToExcel'));
        $this->addButton(new NewModel('product-unit.create'));
    }

    public function exportToExcel()
    {
        return parent::_exportToExcel('Unidades de medida');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('list', [
            'columns' => $this->columns,
            'items' => $this->items,
            'buttons' => $this->buttons
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product-unit.register');
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
            'name' => 'required|max:30',
            'initials' => 'required|max:2'
        ]);

        $unit = Unit::create($request->all());

        return new JsonResponse([
            'message' => 'Unidade de medida ' . $unit->id . ' cadastrada com sucesso!',
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
