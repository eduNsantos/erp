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
            ['id' => 1,'module_id' => 2, 'name' => 'Produto'],
            ['id' => 2,'module_id' => 2, 'name' => 'Movimentação'],
            ['id' => 3,'module_id' => 2, 'name' => 'Consultas'],
            ['id' => 4,'module_id' => 3, 'name' => 'Clientes'],
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
