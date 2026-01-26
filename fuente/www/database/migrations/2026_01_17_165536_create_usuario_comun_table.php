<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración para crear la tabla "usuario_comun".
 *
 * Esta tabla almacena la información de los usuarios comunes del sistema,
 * incluyendo datos personales, credenciales de acceso y campos utilizados
 * para la lógica interna de intercambios y asignación de créditos diarios.
 */
return new class extends Migration
{
    /**
     * Ejecuta la migración.
     *
     * Crea la tabla "usuario_comun" con todos los campos necesarios para
     * gestionar la información del usuario, su autenticación y el control
     * de actividades relacionadas con intercambios y créditos.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_comun', function (Blueprint $table) {
            
            $table->id('id_usuario_comun');
            $table->string('nombre_usuario_comun', 100);     
            $table->string('apellidos_usuario_comun', 100);
            $table->string('email_usuario_comun', 100)->unique();
            $table->string('password', 255);
            $table->string('telefono_usuario_comun', 100);
            $table->string('ciudad_usuario_comun', 100);
            $table->timestamp('ultima_revision_intercambios')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Revierte la migración.
     *
     * Elimina la tabla "usuario_comun" si existe.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_comun');
    }
};
