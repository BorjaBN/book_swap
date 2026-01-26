<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración para crear la tabla "evento_cultural".
 *
 * Esta tabla almacena los eventos organizados por entidades culturales.
 * Incluye información descriptiva del evento, su fecha, ubicación, tipo
 * y la relación con la entidad cultural que lo organiza.
 */
return new class extends Migration
{
    /**
     * Ejecuta la migración.
     *
     * Crea la tabla "evento_cultural" con todos los campos necesarios para
     * gestionar los eventos culturales dentro de la aplicación.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento_cultural', function (Blueprint $table) {

            $table->id('id_evento');
            $table->string('nombre_evento', 150);
            $table->dateTime('fecha_evento');
            $table->text('descripcion_evento');
            $table->string('ubicacion_evento', 150);
            $table->enum('tipo_evento', [
                'encuentro con autor/a',
                'club de lectura',
                'feria del libro'
            ]);
            $table->unsignedBigInteger('id_entidad_cultural')->nullable();
            $table->timestamps();
            $table->foreign('id_entidad_cultural')
                  ->references('id_entidad_cultural')
                  ->on('entidad_cultural')
                  ->onDelete('cascade');
        });
    }

    /**
     * Revierte la migración.
     *
     * Elimina la tabla "evento_cultural" si existe.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evento_cultural');
    }
};
