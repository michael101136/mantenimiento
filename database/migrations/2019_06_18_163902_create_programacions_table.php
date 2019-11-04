<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProgramacionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programacions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_orden');
            $table->string('id_medidor');
            $table->string('id_tipo_programacion');
            $table->string('codigo');
            $table->string('descripcion');
            $table->string('estado');
            $table->string('fechainicio');
            $table->string('fechafin');
            $table->string('frecuencia');
            $table->string('lectura');
            $table->string('ultimavez');
            $table->string('fechaprogramacion');
            $table->string('tiempoestimado');
            $table->string('diaestimado');
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
        Schema::drop('programacions');
    }
}
