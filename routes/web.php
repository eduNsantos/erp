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

use App\Module;
use Illuminate\Http\Request;

Route::middleware('check.date')->group(function () {
    Route::get('/', function () {
        $modules = Module::all();
    
        return view('modules', compact('modules'));
    })->name('modules');
    
    Route::group(['prefix' => '/sales'], function () {
        Route::resource('/', 'SalesController');
    });
    
    Route::group(['prefix' => '/stock'], function () {
        Route::get('/', 'RouteController@stock')->name('stock.index');
        Route::resource('/product', 'ProductController');
        Route::resource('/product-unit', 'UnitController');
    });
    
    Route::group(['prefix' => '/general-registration'], function () {
        Route::get('/', 'RouteController@general_registration')->name('general_registration.index');
    });
    
    Route::get('/home', 'HomeController@index')->name('home');
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

Route::get('/test', 'ProductController@test');