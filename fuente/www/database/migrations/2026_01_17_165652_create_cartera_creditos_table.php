<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración para crear la tabla "cartera_creditos".
 *
 * Esta tabla almacena el saldo total de créditos asociado a cada usuario común.
 * Cada usuario tiene una única cartera, y la relación se gestiona mediante
 * una clave foránea hacia la tabla "usuario_comun".
 *
 * La cartera permite controlar:
 * - créditos iniciales
 * - créditos ganados por intercambios
 * - créditos diarios
 * - créditos gastados
 */
return new class extends Migration
{
    /**
     * Ejecuta la migración.
     *
     * Crea la tabla "cartera_creditos" con su clave primaria, el saldo total
     * y la relación con el usuario correspondiente.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartera_creditos', function (Blueprint $table) {
           
            $table->id('id_cartera');
            $table->unsignedBigInteger('saldo_total')->default(0);
            $table->unsignedBigInteger('id_usuario_comun')->nullable();
            $table->timestamps();
            $table->foreign('id_usuario_comun')
                  ->references('id_usuario_comun')
                  ->on('usuario_comun')
                  ->onDelete('cascade');
        });
    }

    /**
     * Revierte la migración.
     *
     * Elimina la tabla "cartera_creditos" si existe.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cartera_creditos');
    }
};
