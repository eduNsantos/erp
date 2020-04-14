<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateProductMovementTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_movement_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
        });

        DB::table('product_movement_types')->insert([
            ['id' => 1, 'name' => 'Entrada reserva'],
            ['id' => 2, 'name' => 'Saída reserva'],
            ['id' => 3, 'name' => 'Entrada real'],
            ['id' => 4, 'name' => 'Saída real']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_movement_types');
    }
}
