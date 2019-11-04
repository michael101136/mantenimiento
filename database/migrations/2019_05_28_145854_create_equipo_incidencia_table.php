<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipoIncidenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipo_incidencia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo');
            $table->string('id_equipo');
            $table->string('id_incidencia');
            $table->string('id_empresa');
            $table->string('fecha_incidencia');
            $table->string('descripcion');
            $table->string('prioridad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipo_incidencia');
    }
}
