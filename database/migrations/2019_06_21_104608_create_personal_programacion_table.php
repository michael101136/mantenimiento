<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalProgramacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_programacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_users');
            $table->string('id_programacion');
            $table->string('id_tipo_programacion');
            $table->string('fecha_inicio');
            $table->string('fecha_fin');
            $table->string('hora_inicio');
            $table->string('hora_fin');
            $table->string('descripcion');
            $table->string('estado');
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
        Schema::dropIfExists('personal_programacion');
    }
}
