<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Controllers\Grid\GridController;
use App\Http\Requests\OrderRequest;
use App\Order;
use App\OrderProduct;
use App\OrderStatus;
use App\Product;
use App\ProductStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends GridController
{
    const TRANSLATION_PREFIX = 'sales.order';

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
        $this->columns = [
            'id' => true,
            'status' => 'name',
            'client' => 'corporate_name',
            'user' => 'name',
            'item_quantity' => true,
            'total_price' => true,
            'created_at' => true,
            'updated_at' => true
        ];
        $this->items = Order::with('client', 'user', 'status')->get();

        return view('order.list', [
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
            ->with('unit', 'balances')
            ->get()
        ;
        $status = OrderStatus::find(1);
        $clients = Client::all();

        return view('order.register', compact('products', 'clients', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $order = Order::create([ 
            'client_id' => $request->client_id,
            'user_id' => Auth::id(),
            'order_status_id' => $request->order_status_id
        ]);

        for ($i = 0; $i < count($request->product_id); $i++ ) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $request->product_id[$i],
                'quantity' => $request->quantity[$i]
            ]);
            
            $movement = new MovementController();
            $movement->setProductId($request->product_id[$i]);
            $movement->setQuantity($request->quantity[$i]);
            $movement->setMovementReason("Pedido de venda " . $order->id . " item " . ($i + 1));
            $movement->reservationEntry();
        }

        return response()->json([
            'message' => "Pedido nº $order->id criado com sucesso!",
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
     * Cancel order
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cancel(Request $request)
    {
        $order = Order::where('id', $request->id)->with('order_products')->first();

        $validation = Validator::make($order->toArray(), [
            'order_status_id' => 'in:'.Order::IN_ANALYSIS
        ], [
            'order_status_id.in' => 'O pedido já está cancelado!'
        ])->validate();

        $order->order_status_id = Order::CANCELED;
        $order->save();
        
        $i = 1;
        foreach ($order->order_products as $product) {
            $movement = new MovementController();
            $movement->setProductId($product->product_id);
            $movement->setQuantity($product->quantity);
            $movement->setMovementReason('Cancelamento do pedido nº ' . $order->id . ' item ' . $i);
            $movement->reservationWithdrawal();
            $i++;
        }
        return response()->json([
            'message' => 'Pedido nº ' . $order->id  . ' cancelado com sucesso!',
            'row' => view('order.row', [
                'order' => Order::find($request->id)->with('user', 'client', 'status')->first()
            ])->render()
        ], 200);
    }

    /**
     * Activate order
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function activate(Request $request)
    {
        $order = Order::where('id', $request->id)->with('order_products', 'status', 'client', 'user')->first();

        $validation = Validator::make($order->toArray(), [
            'order_status_id' => 'in:'.Order::CANCELED
        ], [
            'order_status_id.in' => 'Só é possível ativar um pedido cancelado!'
        ])->validate();

        $order->order_status_id = Order::IN_ANALYSIS;
        $order->save();

        $i = 1;
        foreach ($order->order_products as $product) {
            $movement = new MovementController();
            $movement->setProductId($product->id);
            $movement->setQuantity($product->quantity);
            $movement->setMovementReason('Ativação do pedido nº ' . $order->id . ' item ' . $i);
            $movement->reservationEntry();
            $i++;
        }
        
        return response()->json([
            'message' => 'Pedido nº ' . $order->id  . ' ativado com sucesso!',
            'row' => view('order.row', [
                'order' => Order::find($request->id)->with('user', 'client', 'status')->first()
            ])->render(),
        ], 200);
    }
}
