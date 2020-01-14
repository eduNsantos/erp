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
use App\ModuleMenu;

Route::get('/', function () {
    $modules = Module::all();

    return view('modules', compact('modules'));
});

Route::group(['prefix' => '/sales'], function () {
    Route::resource('/', 'SalesController');
});

Route::group(['prefix' => '/stock'], function () {
    Route::get('/', function () {
        $menus = ModuleMenu::whereHas('functions')->get();

        return view('stock.menu', compact('menus'));
    })->name('stock.index');
    Route::resource('/product', 'ProductController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
