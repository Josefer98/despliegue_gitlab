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
        Schema::create('reporte_temas', function (Blueprint $table) {
            $table->string('action');
            $table->unsignedBigInteger('id_tema');
            $table->unsignedBigInteger('user_id')->nullable(); // Si quieres registrar el usuario que hizo la acción
            $table->timestamps();
            
            $table->foreign('id_tema')->references('id_tema')->on('temas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reporte_temas');
    }
};
