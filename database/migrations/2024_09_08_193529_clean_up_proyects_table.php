<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CleanUpProyectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proyects', function (Blueprint $table) {
            // Si la columna existe, la eliminamos
            if (Schema::hasColumn('proyects', 'fechainicio')) {
                $table->dropColumn('fechainicio');
            }
            if (Schema::hasColumn('proyects', 'estado')) {
                $table->dropColumn('estado');
            }
            if (Schema::hasColumn('proyects', 'responsable')) {
                $table->dropColumn('responsable');
            }
            if (Schema::hasColumn('proyects', 'monto')) {
                $table->dropColumn('monto');
            }
            if (Schema::hasColumn('proyects', 'created_by')) {
                $table->dropColumn('created_by');
            }
            if (Schema::hasColumn('proyects', 'description')) {
                $table->dropColumn('description');
            }
            if (Schema::hasColumn('proyects', 'image')) {
                $table->dropColumn('image');
            }
            if (Schema::hasColumn('proyects', 'active')) {
                $table->dropColumn('active');
            }
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
            // Volver a agregar las columnas en caso de rollback
            $table->datetime('fechainicio')->nullable();
            $table->tinyInteger('estado')->default(0);
            $table->string('responsable')->notNullable();
            $table->integer('monto')->notNullable();
            $table->unsignedBigInteger('created_by');
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('active')->default(1);
        });
    }
}
