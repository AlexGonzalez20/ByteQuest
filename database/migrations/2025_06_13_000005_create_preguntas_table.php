<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('preguntas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('leccion_id')->constrained('lecciones')->onDelete('cascade');
            $table->string('pregunta');
            $table->string('imagen')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('preguntas');
    }
};
