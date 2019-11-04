<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('idequipo')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('id_marca')->nullable();
            $table->string('id_pais')->nullable();
            $table->string('peso')->nullable();
            $table->string('modelo')->nullable();
            $table->string('peso_envio')->nullable();
            $table->string('estado_cliente')->nullable();
            $table->string('umedpeso')->nullable();
            $table->string('altura')->nullable();
            $table->string('ancho')->nullable();
            $table->string('largo')->nullable();
            $table->string('funcion')->nullable();
            $table->string('ImagenA')->nullable();
            $table->string('Imagen')->nullable();
            $table->string('umedimens')->nullable();
            $table->string('caracteristicatecnica')->nullable();
            $table->string('cantidad')->nullable();
            $table->string('potencia')->nullable();
            $table->string('tipotenc')->nullable();
            $table->string('user_crea')->nullable();
            $table->string('estado_equipo')->nullable();
            $table->string('id_empresa')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipo');
    }
}
