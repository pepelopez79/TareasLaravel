<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasTable extends Migration
{
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha')->useCurrent();
            $table->tinyText('lugar');
            $table->tinyText('prioridad');
            $table->tinyText('estado');
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->string('imagen', 40);
            $table->string('titulo');
            $table->text('contenido');
            $table->timestamps();
            
            $table->foreign('usuario_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tareas');
    }
}
