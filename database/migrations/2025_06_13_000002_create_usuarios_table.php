<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('dias_racha')->default(0);
            $table->integer('vidas')->default(5);
            $table->integer('experiencia')->default(0);
            $table->date('ultimo_dia_activo')->nullable();
            $table->foreignId('rol_id')->default(1)->constrained('roles')->onDelete('cascade');
            $table->timestamps(); // created_at y updated_at
        });

        DB::table('usuarios')->insert([
            [
                'nombre'      => 'Admin',
                'apellido'    => 'ByteQuest',
                'email'       => 'admin@bytequest.com',
                'password'    => Hash::make('12345678'),
                'rol_id'       => 2,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
