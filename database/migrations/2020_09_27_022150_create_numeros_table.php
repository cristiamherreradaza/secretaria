<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNumerosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('numeros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('hojas_ruta_id')->nullable();
            $table->foreign('hojas_ruta_id')->references('id')->on('hojas_rutas');
            $table->unsignedBigInteger('documento_id')->nullable();
            $table->foreign('documento_id')->references('id')->on('documentos');
            $table->integer('numero')->nullable();
            $table->string('gestion', 4)->nullable();
            $table->datetime('fecha')->nullable();
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
        Schema::dropIfExists('numeros');
    }
}
