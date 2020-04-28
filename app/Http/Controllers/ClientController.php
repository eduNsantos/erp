<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Controllers\Grid\GridController;
use App\Http\Requests\ClientRequest;
use Illuminate\Http\Request;

class ClientController extends GridController
{
    const TRANSLATION_PREFIX = 'client';

    public function __construct()
    {
        $this->columns = [
            'person_type' => true,
            'register_number' => true,
            'corporate_name' => true,
            'fantasy_name' => true,
            // 'main_contact' => 'client_id',
            // 'main_contact' => 'name',
            // 'main_contact' => 'email',
            // 'main_contact' => 'phone',
            // 'main_contact' => 'email_receive_nfe',
            // 'main_contact' => 'email_receive_charge'
        ];

        $this->items = Client::all();;
    }

    /**
     * Export data to excel
     */
    public function exportToExcel()
    {
        return parent::_exportToExcel('Listagem de clientes');
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
            'items' => $this->items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request) {
        Client::create($request->all());

        return response()->json([
            'message' => 'Cliente cadastrado com sucesso!',
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
