<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 30);
            $table->string('initials', 2);
            $table->timestamps();
        });

        DB::table('units')->insert([
            [
                'name' => 'Caixa',
                'initials' => 'CX'
            ],
            [
                'name' => 'Quilo',
                'initials' => 'KG'
            ],
            [
                'name' => 'Unidade',
                'initials' => 'UN'
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('units');
    }
}
