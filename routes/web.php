<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Middleware\Modules\Sales;
use App\Http\Middleware\Modules\Stock;
use App\Module;
use Illuminate\Http\Request;

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        $modules = Module::all();
    
        return view('modules', compact('modules'));
    })->name('modules');
    
    Route::group(['prefix' => '/sales', 'middleware' => Sales::class], function () {
        Route::get('/', function () { 
            return view('menu');
        })->name('sales.index');
        Route::get('/client/exportToExcel', 'ClientController@exportToExcel');
        Route::resource('/client', 'ClientController');
        Route::get('/order/exportToExcel', 'OrderController@exportToExcel');
        Route::put('/order/cancel', 'OrderController@cancel');
        Route::put('/order/activate', 'OrderController@activate');
        Route::resource('/order', 'OrderController');
    });
    
    Route::group(['prefix' => '/stock', 'middleware' => Stock::class], function () {
        Route::get('/', function () { 
            return view('menu');
        })->name('stock.index');
        Route::get('/product/exportToExcel', 'ProductController@exportToExcel');
        Route::get('/product/movement/{productId?}', 'ProductController@movements')->name('product.movements');
        Route::resource('/product', 'ProductController');
        Route::get('/product-unit/exportToExcel', 'UnitController@exportToExcel');
        Route::resource('/product-unit', 'UnitController');
    });
    
    Route::group(['prefix' => '/general-registration'], function () {
        Route::get('/', function () { response('a'); })->name('general_registration.index');
    });    
});

Auth::routes();

Route::post('/change-date', function (Request $request) {
    session(['date' => [
        'initial_date' => strtotime($request->input('initial_date')),
        'final_date' => strtotime($request->input('final_date')),
        ]
    ]);

    return $request;
});

Route::get('/date', function () { session('date'); });
