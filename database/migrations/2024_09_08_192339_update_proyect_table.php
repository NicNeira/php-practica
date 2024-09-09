<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdteProyect extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proyects', function (Blueprint $table) {
            $table->string('name')->nullable()->change();  // Si deseas cambiar alguna columna existente
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('user_id_create');
            $table->unsignedBigInteger('user_id_last_update')->nullable();
            $table->boolean('active')->default(true);

            // Si 'created_by' no existe aún, lo añades:
            $table->foreign('user_id_create')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id_last_update')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proyects', function (Blueprint $table) {
            $table->dropForeign(['user_id_create']);
            $table->dropForeign(['user_id_last_update']);
            $table->dropColumn('nombre', 'descripcion', 'imagen', 'user_id_create', 'user_id_last_update', 'activo');
        });
    }
}
