<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->tinyInteger('curso')->unsigned()->nullable(false);
            $table->string('cu', 6)->unique(); // Se define para aceptar 6 caracteres
            $table->unsignedBigInteger('tema_asignado')->nullable(); // Cambia el nombre de la columna
            $table->timestamp('fecha_asignacion')->nullable();
            $table->timestamp('fecha_desasignacion')->nullable();

            $table->timestamps();
            
            $table->foreign('tema_asignado')->references('id_tema')->on('temas'); // Agrega la restricción de clave foránea
        });

        // Restricción para asegurarse de que solo se acepten valores del 1 al 9 en el campo "curso"
        DB::statement('ALTER TABLE estudiantes ADD CONSTRAINT check_curso_range CHECK (curso BETWEEN 1 AND 9)');
        
        // Restricción para asegurarse de que el formato del campo "cu" sea tres valores seguidos de un guion y luego dos dígitos
        DB::statement('ALTER TABLE estudiantes ADD CONSTRAINT check_cu_format CHECK (LENGTH(cu) = 6 AND cu REGEXP "^[0-9]{3}-[0-9]{2}$")');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
