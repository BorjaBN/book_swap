<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración para crear la tabla "entidad_cultural".
 *
 * Esta tabla almacena la información de las entidades culturales registradas
 * en el sistema. Incluye datos de identificación, contacto, autenticación
 * y metadatos opcionales como la web oficial.
 *
 * Las entidades culturales funcionan como un tipo de usuario independiente
 * dentro de la aplicación, con su propio guard y provider de autenticación.
 */
return new class extends Migration
{
    /**
     * Ejecuta la migración.
     *
     * Crea la tabla "entidad_cultural" con todos los campos necesarios para
     * gestionar la información de las entidades culturales, incluyendo datos
     * de acceso y atributos descriptivos.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entidad_cultural', function (Blueprint $table) {

            $table->id('id_entidad_cultural');
            $table->string('nombre_entidad_cultural', 100);
            $table->string('email_entidad_cultural', 100)->unique();
            $table->string('password', 255);
            $table->string('telefono_entidad_cultural', 100);
            $table->string('ciudad_entidad_cultural', 100);
            $table->string('direccion_entidad_cultural', 255);
            $table->string('web_entidad_cultural', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Revierte la migración.
     *
     * Elimina la tabla "entidad_cultural" si existe.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entidad_cultural');
    }
};
