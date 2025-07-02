<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leccion_usuario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->foreignId('leccion_id')->constrained('lecciones')->onDelete('cascade');
            $table->boolean('xp_reclamada')->default(false);
            $table->timestamps();
            $table->unique(['usuario_id', 'leccion_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leccion_usuario');
    }
};
