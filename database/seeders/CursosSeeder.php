<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cursos')->insert([
            [
                'nombre' => 'PHP',
                'descripcion' => 'Aprende los fundamentos de PHP, uno de los lenguajes más usados para desarrollo web. Conoce variables, estructuras de control, funciones y conexión con bases de datos.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'JavaScript',
                'descripcion' => 'Domina JavaScript, el lenguaje clave para crear páginas web interactivas y dinámicas. Aprende desde lo básico hasta manipulación del DOM y programación asíncrona.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
