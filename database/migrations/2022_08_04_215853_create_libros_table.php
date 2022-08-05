<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('autor', 40);
            $table->string('titulo', 40);
            $table->string('edicion', 30);
            $table->text('datos_publicacion');
            $table->text('tipo_contenido');
            $table->string('restricciones', 30);
            $table->string('materia', 30);
            $table->string('provedor', 30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libros');
    }
}
