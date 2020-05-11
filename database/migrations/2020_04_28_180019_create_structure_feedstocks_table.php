<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStructureFeedstocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('structure_feedstocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('feedstock_type_id');
            $table->unsignedBigInteger('structure_id');
            $table->unsignedBigInteger('product_id');
            $table->decimal('quantity', 15, 6);
            $table->timestamps();

            $table->foreign('feedstock_type_id')->references('id')->on('feedstock_types');
            $table->foreign('structure_id')->references('id')->on('structures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('structure_feedstocks');
    }
}
