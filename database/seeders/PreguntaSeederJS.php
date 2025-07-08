<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pregunta;
use App\Models\Respuesta;

class PreguntaSeederJS extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leccionId = 11; // ⚡ Asegúrate de que es la prueba correcta

        $preguntas = [
            [
                'pregunta' => '¿Cómo se declara una variable en PHP?',
                'opciones' => [
                    ['texto' => '$variable;', 'es_correcta' => true],
                    ['texto' => 'var variable;', 'es_correcta' => false],
                    ['texto' => 'let variable;', 'es_correcta' => false],
                    ['texto' => 'variable = $value;', 'es_correcta' => false],
                ]
            ]
        ];
        foreach ($preguntas as $q) {
            $pregunta = Pregunta::firstOrCreate([
                'leccion_id' => $leccionId,
                'pregunta' => $q['pregunta'],
                'imagen' => null,
            ]);

            foreach ($q['opciones'] as $opcion) {
                Respuesta::firstOrCreate([
                    'pregunta_id' => $pregunta->id,
                    'texto' => $opcion['texto'],
                    'es_correcta' => $opcion['es_correcta'],
                ]);
            }
        }
    }
}
