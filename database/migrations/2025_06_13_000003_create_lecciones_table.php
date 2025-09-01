<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lecciones', function (Blueprint $table) {
            $table->id(); // Clave primaria obligatoria
            $table->string('nombre');
            $table->text(column: 'descripcion');
            $table->longText('contenido')->nullable(); // Campo opcional para contenido de la lección
            $table->foreignId('curso_id')->constrained('cursos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecciones');
    }
};
