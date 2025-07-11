<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Ej: Admin, User
            $table->timestamps();
        });

        // Insertar roles por defecto
        DB::table('roles')->insert([
            ['id' => 1, 'nombre' => 'Estudiante', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nombre' => 'Administrador', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
