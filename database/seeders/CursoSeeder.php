<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Curso;

class CursoSeeder extends Seeder
{
    public function run(): void
    {
        Curso::create([
            'nombre_curso' => 'Curso de Prueba',
            'descripcion' => 'Este es un curso de prueba para verificar el flujo de edición.'
        ]);
    }
}
