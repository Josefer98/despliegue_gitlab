<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTemaAsignadoToUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('tema_asignado')->nullable(); // Cambiado a un tipo numérico
            $table->foreign('tema_asignado')->references('id')->on('temas'); // Agregada la clave foránea
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['tema_asignado']);
            $table->dropColumn('tema_asignado');
        });
    }
}

