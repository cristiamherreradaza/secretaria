<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHojasRutasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hojas_rutas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('unidade_id')->nullable();
            $table->foreign('unidade_id')->references('id')->on('unidades');
            $table->string('hoja_ruta', 150)->nullable();
            $table->date('fecha')->nullable();
            $table->string('unidad_solicitante', 150)->nullable();
            $table->string('detalle', 500)->nullable();
            $table->string('resolucion', 150)->nullable();
            $table->string('obs_correspondencia', 800)->nullable();
            $table->string('obs_asignacion', 800)->nullable();
            $table->datetime('fecha_asignacion')->nullable();
            $table->datetime('fecha_numero')->nullable();
            $table->integer('numero')->nullable();
            $table->string('gestion', 4)->nullable();
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
        Schema::dropIfExists('hojas_rutas');
    }
}
