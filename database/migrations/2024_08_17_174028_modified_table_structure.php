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
        // Modificar la tabla 'users'
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'name')) {
                $table->renameColumn('name', 'nombre');
            }

            if (!Schema::hasColumn('users', 'activo')) {
                $table->boolean('activo')->default(false);
            }
        });

        // Modificar la tabla 'password_reset_tokens'
        Schema::table('password_reset_tokens', function (Blueprint $table) {
            // No se intenta agregar la columna 'email' ya que ya existe
            if (!Schema::hasColumn('password_reset_tokens', 'token')) {
                $table->string('token');  // Añade el campo 'token' si no existe
            }
        });

        // Modificar la tabla 'sessions'
        Schema::table('sessions', function (Blueprint $table) {
            // Asegúrate de no agregar columnas que ya existan
            if (!Schema::hasColumn('sessions', 'payload')) {
                $table->longText('payload');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir cambios en la tabla 'users'
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'nombre')) {
                $table->renameColumn('nombre', 'name');
            }

            if (Schema::hasColumn('users', 'activo')) {
                $table->dropColumn('activo');
            }
        });

        // Revertir cambios en la tabla 'password_reset_tokens'
        Schema::table('password_reset_tokens', function (Blueprint $table) {
            if (Schema::hasColumn('password_reset_tokens', 'token')) {
                $table->dropColumn('token');
            }
        });

        // Revertir cambios en la tabla 'sessions'
        Schema::table('sessions', function (Blueprint $table) {
            if (Schema::hasColumn('sessions', 'payload')) {
                $table->dropColumn('payload');
            }
        });
    }
};
