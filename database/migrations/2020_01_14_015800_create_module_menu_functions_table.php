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
            $table->string('module_menu_id');
            $table->string('name');
            $table->string('icon');
            $table->string('route');
            $table->timestamps();

            $table->foreign('module_menu_id')->references('id')->on('module_menus');
        });

        DB::table('module_menu_functions')->insert([
            ['module_menu_id' => 1, 'name' => 'Produto', 'icon' => 'fas fa-wine-bottle', 'route' => 'product.index']
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
