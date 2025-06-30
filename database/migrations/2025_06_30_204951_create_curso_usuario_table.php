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
        Schema::create('curso_usuario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->foreignId('curso_id')->constrained('cursos')->onDelete('cascade');

            // Progreso actual
            $table->foreignId('leccion_actual_id')->nullable()->constrained('lecciones')->onDelete('set null');
            $table->foreignId('pregunta_actual_id')->nullable()->constrained('preguntas')->onDelete('set null');

            $table->timestamps();

            $table->unique(['usuario_id', 'curso_id']); // Evitar duplicados
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curso_usuario');
    }
};
