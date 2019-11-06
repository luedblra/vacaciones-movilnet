<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_periodo_id')->unsigned();
            $table->integer('fecha_i');
            $table->integer('fecha_f');
            $table->integer('dias_t');
            $table->timestamps();
            $table->foreign('user_periodo_id')->references('id')->on('usuario_periodos');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacaciones');
    }
}
