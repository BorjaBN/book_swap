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
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('cartera_creditos');
    }
};


    