<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración para crear la tabla "libro".
 *
 * Esta tabla almacena la información de los libros registrados por los
 * usuarios comunes, incluyendo datos bibliográficos, estado, imagen y
 * la relación con el usuario propietario.
 */
return new class extends Migration
{
    /**
     * Ejecuta la migración.
     *
     * Crea la tabla "libro" con sus campos principales y la relación
     * con la tabla "usuario_comun".
     */
    public function up()
    {
        Schema::create('libro', function (Blueprint $table) {
            $table->id('id_libro');
            $table->string('titulo_libro', 150);
            $table->string('autor_libro', 150);
            $table->string('ISBN', 20)->unique();
            $table->enum('estado_libro', ['nuevo', 'seminuevo', 'usado']);
            $table->string('genero_libro', 150)->nullable();
            $table->date('fecha_publicacion_libro');
            $table->string('estado_intercambio')->default('libre');
            $table->string('imagen_libro');
            $table->unsignedBigInteger('id_usuario_comun');
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
     * Elimina la tabla "libro" si existe.
     */
    public function down()
    {
        Schema::dropIfExists('libro');
    }
};
