<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('module_id');
            $table->string('name', 50);
            $table->timestamps();

            $table->foreign('module_id')->references('id')->on('modules');
        });

        DB::table('module_menus')->insert([
            ['module_id' => 2, 'name' => 'Produto'],
            ['module_id' => 2, 'name' => 'Movimentação'],
            ['module_id' => 2, 'name' => 'Consultas'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_menus');
    }
}
