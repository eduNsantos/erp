<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateProductBalanceTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_balance_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 30);
        });

        DB::table('product_balance_types')->insert([
            ['id' => 1, 'name' => 'Físico'],
            ['id' => 2, 'name' => 'Reservado'],
            ['id' => 3, 'name' => 'Disponível'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_balance_types');
    }
}
