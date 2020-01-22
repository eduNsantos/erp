<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleMenuFunctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_menu_functions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('module_menu_id');
            $table->string('name');
            $table->string('icon');
            $table->string('route');
            $table->timestamps();

            $table->foreign('module_menu_id')->references('id')->on('module_menus');
        });

        DB::table('module_menu_functions')->insert([
            ['module_menu_id' => 1, 'name' => 'Produto', 'icon' => 'fas fa-wine-bottle', 'route' => 'product.create'],
            ['module_menu_id' => 1, 'name' => 'Consulta de produto', 'icon' => 'fas fa-boxes', 'route' => 'product.index'],
            ['module_menu_id' => 1, 'name' => 'Unidade de medida', 'icon' => 'fas fa-folder', 'route' => 'product-unit.index'],
            ['module_menu_id' => 1, 'name' => 'Categoria de produto', 'icon' => 'fas fa-folder', 'route' => 'product.index'],
            ['module_menu_id' => 1, 'name' => 'Grupo de produto', 'icon' => 'fas fa-folder', 'route' => 'product.index'],
            ['module_menu_id' => 1, 'name' => 'Marca de produto de produto', 'icon' => 'fas fa-folder', 'route' => 'product.index'],
            ['module_menu_id' => 2, 'name' => 'Movimentação de estoque por produto', 'icon' => 'fas fa-search', 'route' => 'product.index'],
            ['module_menu_id' => 4, 'name' => 'Marca de produto', 'icon' => 'fas fa-edit', 'route' => 'product.index'],
            ['module_menu_id' => 4, 'name' => 'Grupo de produto', 'icon' => 'fas fa-archive', 'route' => 'product.index'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_menu_functions');
    }
}
