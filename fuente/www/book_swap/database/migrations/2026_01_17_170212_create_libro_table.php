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
        Schema::create('libro', function (Blueprint $table) {
            $table->id('id_libro');
            $table->string('titulo_libro', 150);
            $table->string('autor_libro', 150);
            $table->string('ISBN', 20)->unique();
            $table->enum('estado_libro', ['nuevo', 'seminuevo', 'usado']);
            $table->string('genero_libro', 150)->nullable();
            $table->date('fecha_publicacion_libro');
            
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
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('libro');
    }
};


    