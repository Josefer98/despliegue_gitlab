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
        Schema::create('temas', function (Blueprint $table) {
            $table->id('id_tema');
            $table->string('titulo');
            $table->string('area');
            $table->string('palabras_clave');
            $table->enum('estado', ['asignado', 'libre', 'terminado']);
            $table->text('descripcion');
            $table->text('pdf_file');
            
            $table->unsignedBigInteger('docente_id');

            $table->timestamps();
            $table->foreign('docente_id')->references('id_docente')->on('docentes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temas');
    }
};
