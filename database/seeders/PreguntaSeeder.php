<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pregunta;
use App\Models\Respuesta;

class PreguntaSeeder extends Seeder
{
    public function run(): void
    {
        // ⚡ Lección 1 de PHP => id = 1 (ajusta si es diferente)
        $leccionId = 1;

        // Preguntas de ejemplo
        $preguntas = [
            [
                'pregunta' => '¿Cómo se declara una variable en PHP?',
                'opciones' => [
                    ['texto' => '$variable;', 'es_correcta' => true],
                    ['texto' => 'var variable;', 'es_correcta' => false],
                    ['texto' => 'let variable;', 'es_correcta' => false],
                    ['texto' => 'variable = $value;', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Cuál es el prefijo obligatorio para variables en PHP?',
                'opciones' => [
                    ['texto' => '$', 'es_correcta' => true],
                    ['texto' => '@', 'es_correcta' => false],
                    ['texto' => '#', 'es_correcta' => false],
                    ['texto' => '&', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué tipo de dato puede tener una variable en PHP?',
                'opciones' => [
                    ['texto' => 'String', 'es_correcta' => false],
                    ['texto' => 'Integer', 'es_correcta' => false],
                    ['texto' => 'Array', 'es_correcta' => false],
                    ['texto' => 'Todos los anteriores', 'es_correcta' => true],
                ]
            ],
            [
                'pregunta' => '¿Cuál es la forma correcta de asignar un valor a una variable?',
                'opciones' => [
                    ['texto' => '$x = 10;', 'es_correcta' => true],
                    ['texto' => 'x := 10;', 'es_correcta' => false],
                    ['texto' => 'int x = 10;', 'es_correcta' => false],
                    ['texto' => 'let $x = 10;', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué símbolo se usa para concatenar strings en PHP?',
                'opciones' => [
                    ['texto' => '.', 'es_correcta' => true],
                    ['texto' => '+', 'es_correcta' => false],
                    ['texto' => '&', 'es_correcta' => false],
                    ['texto' => '||', 'es_correcta' => false],
                ]
            ],
        ];

        foreach ($preguntas as $q) {
            $pregunta = Pregunta::create([
                'leccion_id' => $leccionId,
                'pregunta' => $q['pregunta'],
                'imagen' => null, // Si no hay imagen
            ]);

            foreach ($q['opciones'] as $opcion) {
                Respuesta::create([
                    'pregunta_id' => $pregunta->id,
                    'texto' => $opcion['texto'],
                    'es_correcta' => $opcion['es_correcta'],
                ]);
            }
        }
    }
}
