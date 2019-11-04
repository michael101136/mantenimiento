<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLogiProveedoresTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logi__proveedores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('razonsoc');
            $table->string('ruc');
            $table->string('user_create');
            $table->string('web');
            $table->string('estado');
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
        Schema::drop('logi__proveedores');
    }
}
