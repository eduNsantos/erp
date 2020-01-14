<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 30);
            $table->string('icon', 255);
            $table->string('route', 255);
            $table->timestamps();
        });

        DB::table('modules')->insert([
            ['name' => 'Faturamento', 'icon' => 'fas fa-scroll', 'route' => '#'],
            ['name' => 'Estoque', 'icon' => 'fas fa-boxes', 'route' => 'stock.index'],
            ['name' => 'Vendas', 'icon' => 'fas fa-receipt', 'route' => '#'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
