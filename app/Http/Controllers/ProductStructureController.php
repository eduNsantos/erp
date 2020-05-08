<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Http\Controllers\Grid\Components\ExportExcel;
use App\Http\Controllers\Grid\Components\NewModel;
use App\Http\Controllers\Grid\GridController;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\ProductBalance;
use App\ProductCategory;
use App\ProductGroup;
use App\ProductMovement;
use App\ProductStatus;
use App\Unit;
use Illuminate\Http\Request;

class ProductStructureController extends GridController
{
    const TRANSLATION_PREFIX = "stock.product-structure";

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
            'physical_balance' => true,
            'reserved_balance' => true,
            'available_balance' => true,
            'created_at' => true,
            'updated_at' => true
        ];
        $this->items = Product::with([
                'unit',
                'brand',
                'category',
                'group',
                'status'
            ])
            ->limit(2)
            ->get()
        ;

        $newModel = new ExportExcel('product-structure.exportToExcel');
        $newModel = new NewModel('product-structure.create', 'Adicionar nova estrutura');
        $newModel->setUsesModal(false);

        $this->addButton(new ExportExcel('product-structure.exportToExcel'));
        $this->addButton($newModel);

        parent::__construct();
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
        return view('list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $finishedProducts = Product::with('unit')
            ->where('is_finished_product', true)
            ->get()
        ;
        $feedstockProducts = Product::with('unit')
            ->where('is_feedstock', true)
            ->get()
        ;
        $packageProducts = Product::with('unit')
            ->where('is_package', true)
            ->get()
        ;

        return view('product.structure.register', [
            'finishedProducts' => $finishedProducts,
            'feedstockProducts' => $feedstockProducts,
            'packageProducts' => $packageProducts,
        ]);
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
        
        ProductBalance::createDefaultProductBalance($product->id);

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

    public function movements($productId = null)
    {
        $productMovement = ProductMovement::with('type', 'product');

        if (isset($productId)) {
            $productMovement = $productMovement::where('product_id', $productId);
        }

        return view('product.movements', [
            'columns' => [
                'id' => true,
                'code' => true,
                'name' => true,
                'description' => true,
                'type' => true,
                'quantity' => true,
                'reason' => true,
                'created_at' => true,
                'updated_at' => true,
            ],
            'items' => $productMovement->get()
        ]);
    }
}
