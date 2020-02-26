<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\OrderRequest;
use App\Product;
use App\ProductStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends GridController
{
    public function __construct()
    {
        // $this->items = Order
    }
    /**
     * Export data to excel
     */

    public function exportToExcel()
    {
        parent::_exportToExcel('Listagem de pedidos');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('list', [
            'items' => $this->items,
            'columns' => $this->columns
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::has('status', ProductStatus::ACTIVE)
            ->with('unit')
            ->get()
        ;
        $clients = Client::all();

        return view('order.register', compact('products', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $order = [ 
            'client_id' => $request->client_id,
            'user_id' => Auth::id()
        ];

        dd($order);

        for ($i = 0; $i < count($request->product_id); $i++ ) {
            $product = Product::find($request->product_id[$i]);
            $quantity = $request->quantity[$i];
        }
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
