<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Leccion;

class LeccionSeeder extends Seeder
{
    public function run()
    {
        Leccion::create([
            'curso_id' => 1, // Cambia por el ID de un curso existente
            'nombre_leccion' => 'Introducción a Laravel',
            'descripcion' => 'Esta lección cubre los conceptos básicos de Laravel.',
        ]);
    }
}