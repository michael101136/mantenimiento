<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_servicio', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('codigo');
            $table->integer('id_incidencia');
            $table->integer('id_tipo_mantenimiento');
            $table->integer('id_usuario');
            $table->integer('id_usuario_supervisor');
            $table->integer('prioridad');
            $table->string('fecha');
            $table->text('descripcion');
            $table->integer('estado');
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
        Schema::dropIfExists('orden_servicio');
    }
}
