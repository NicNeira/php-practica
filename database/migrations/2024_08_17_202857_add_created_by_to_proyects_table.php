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
        Schema::create('proyects', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            // Para agregar una columna de fecha personalizada, debes usar timestamp() en lugar de timestamps()
            $table->timestamp('fechainicio')->nullable();
            $table->boolean('estado')->default(false);
            $table->string('responsable');
            $table->integer('monto');
            $table->unsignedBigInteger('created_by');

            // Definir la relación con la tabla users
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('proyects', function (Blueprint $table) {
            $table->dropForeign(['created_by']);  // Eliminar la clave foránea en rollback
            $table->dropIfExists('proyects');
        });
    }
};
