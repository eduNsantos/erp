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
    Route::get('/', 'RouteController@stock')->name('stock.index');
    Route::resource('/product', 'ProductController');
});

Route::group(['prefix' => '/general-registration'], function () {
    Route::get('/', 'RouteController@general_registration')->name('general_registration.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
