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
        Schema::create('movimiento_credito', function (Blueprint $table) {
            $table->id('id_movimiento');
            $table->bigInteger('cantidad'); 
            
            $table->dateTime('fecha_movimiento')->useCurrent();
            $table->unsignedBigInteger('id_cartera')->nullable();
            $table->unsignedBigInteger('id_libro')->nullable();
            $table->text('descripcion'); 
            $table->timestamps();

            $table->foreign('id_cartera')
                  ->references('id_cartera')
                  ->on('cartera_creditos')
                  ->onDelete('cascade');
                  
            $table->foreign('id_libro')
                  ->references('id_libro')
                  ->on('libro')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('movimiento_credito');
    }
};


    