<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateOrderStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50);
            $table->timestamps();
        });

        DB::table('order_statuses')->insert([
            ['id' => 1, 'name' => 'Em análise'],
            ['id' => 2, 'name' => 'Fechado'],
            ['id' => 3, 'name' => 'Cancelado'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_statuses');
    }
}
