<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVinculacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vinculaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('hojas_ruta_id')->nullable();
            $table->foreign('hojas_ruta_id')->references('id')->on('hojas_rutas');
            $table->unsignedBigInteger('vinculada_id')->nullable();
            $table->foreign('vinculada_id')->references('id')->on('hojas_rutas');
            $table->datetime('fecha')->nullable();
            $table->string('estado', 30)->nullable();
            $table->datetime('deleted_at')->nullable();
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
        Schema::dropIfExists('vinculaciones');
    }
}
