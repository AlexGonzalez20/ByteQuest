<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgresoPreguntasTable extends Migration
{
    public function up()
    {
        Schema::create('progreso_preguntas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->foreignId('prueba_id')->constrained('pruebas')->onDelete('cascade');
            $table->foreignId('pregunta_id')->constrained('preguntas')->onDelete('cascade');
            $table->boolean('respondida')->default(false); // 👉 para marcar si ya se respondió
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('progreso_preguntas');
    }
}
