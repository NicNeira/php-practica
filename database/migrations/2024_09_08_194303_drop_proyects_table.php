<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropProyectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('proyects'); // Elimina la tabla proyects
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('proyects', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
            $table->string('descripcion')->nullable();
            $table->string('imagen')->nullable();
            $table->unsignedBigInteger('user_id_create');
            $table->unsignedBigInteger('user_id_last_update')->nullable();
            $table->boolean('activo')->default(true);

            // Definir claves foráneas
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id_create')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id_last_update')->references('id')->on('users')->onDelete('set null');
        });
    }
}
