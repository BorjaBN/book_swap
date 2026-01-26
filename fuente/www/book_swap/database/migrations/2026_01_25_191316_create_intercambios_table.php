<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('intercambios', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('libro_id');
        $table->unsignedBigInteger('solicitante_id');
        $table->unsignedBigInteger('propietario_id');
        $table->enum('estado', ['pendiente', 'aceptado', 'rechazado'])->default('pendiente');
        $table->unsignedBigInteger('libro_ofrecido_id')->nullable(); 
        $table->timestamps();

        $table->foreign('libro_id')->references('id_libro')->on('libro')->onDelete('cascade');
        $table->foreign('solicitante_id')->references('id_usuario_comun')->on('usuario_comun')->onDelete('cascade');
        $table->foreign('propietario_id')->references('id_usuario_comun')->on('usuario_comun')->onDelete('cascade');
        $table->foreign('libro_ofrecido_id') ->references('id_libro') ->on('libro') ->onDelete('set null');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intercambios');
    }
};
