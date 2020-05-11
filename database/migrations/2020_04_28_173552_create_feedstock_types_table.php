<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedstockTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedstock_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 25);
        });

        DB::table('feedstock_types')->insert([
            ['name' => 'Materia-prima'],
            ['name' => 'Embalagem']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedstock_types');
    }
}
