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
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('entidad_cultural');
    }
};


    