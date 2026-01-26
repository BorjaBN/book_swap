<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
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

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('usuario_comun');
    }
};


