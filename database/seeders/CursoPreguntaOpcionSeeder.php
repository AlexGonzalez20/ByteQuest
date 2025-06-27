<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursoPreguntaOpcionSeeder extends Seeder
{
    public function run()
    {
        // Insertar cursos
        $cursoId = DB::table('cursos')->insertGetId([
            'nombre_curso' => 'Matemáticas Básicas',
            'descripcion' => 'Curso introductorio de matemáticas',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insertar pregunta
        $preguntaId = DB::table('preguntas')->insert([
    'leccion_id' => 1, // Usa un ID válido de la tabla lecciones
    'pregunta' => '¿Cuánto es 2 + 2?',
    'img' => null, // O la ruta de la imagen si tienes una
    'created_at' => now(),
    'updated_at' => now(),
]);

        // Insertar opciones
        DB::table('opciones')->insert([
            [
                'pregunta_id' => $preguntaId,
                'texto_opcion' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pregunta_id' => $preguntaId,
                'texto_opcion' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pregunta_id' => $preguntaId,
                'texto_opcion' => '5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
