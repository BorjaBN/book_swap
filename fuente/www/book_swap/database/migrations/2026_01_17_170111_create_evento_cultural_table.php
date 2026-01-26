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
        Schema::create('evento_cultural', function (Blueprint $table) {
            $table->id('id_evento');
            $table->string('nombre_evento', 150);
            $table->dateTime('fecha_evento');
            $table->text('descripcion_evento');
            $table->string('ubicacion_evento', 150);
            $table->enum('tipo_evento', ['encuentro con autor/a', 'club de lectura', 'feria del libro']);
            
            $table->unsignedBigInteger('id_entidad_cultural')->nullable();
            $table->timestamps();

            $table->foreign('id_entidad_cultural')
                  ->references('id_entidad_cultural')
                  ->on('entidad_cultural')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('evento_cultural');
    }
};


    