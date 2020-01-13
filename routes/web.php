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

Route::get('/', function () {
    $modules = [
        'Faturamento', 'Cadastramento geral', 'Estoque', 'SAC', 'Compras', 'PCP'
    ];
    return view('modules', compact('modules'));
});

Route::get('/server', function() {
    var_dump($teste);
});

Route::resource('/product', 'ProductController');