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

use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Module;
use Illuminate\Http\Request;

Route::get('/', function () {
    $modules = Module::all();

    return view('modules', compact('modules'));
})->name('modules');

Route::group(['prefix' => '/sales'], function () {
    Route::get('/', 'RouteController@sales')->name('sales.index');
    Route::get('/client/exportToExcel', 'ClientController@exportToExcel');
    Route::resource('/client', 'ClientController');
    Route::get('/order/exportToExcel', 'OrderController@exportToExcel');
    Route::put('/order/cancel', 'OrderController@cancel');
    Route::resource('/order', 'OrderController');
});

Route::group(['prefix' => '/stock'], function () {
    Route::get('/', 'RouteController@stock')->name('stock.index');
    Route::get('/product/exportToExcel', 'ProductController@exportToExcel');
    Route::resource('/product', 'ProductController');
    Route::get('/product-unit/exportToExcel', 'UnitController@exportToExcel');
    Route::resource('/product-unit', 'UnitController');
});

Route::group(['prefix' => '/general-registration'], function () {
    Route::get('/', 'RouteController@general_registration')->name('general_registration.index');
});

Route::get('/home', 'HomeController@index')->name('home');

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

Route::get('/export', 'ProductController@exportToExcel')->name('export_file');

Route::get('/soap', function () {
    $url = "https://www1.nfe.fazenda.gov.br/NFeDistribuicaoDFe/NFeDistribuicaoDFe.asmx";

    $postFields = [
        'nfeDadosMsg' => '35200167313130000406550020000051801000052365'
    ];

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postFields);
    $retorno = curl_exec($curl);
    curl_close($curl);

    dd($retorno);
});