<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pregunta;
use App\Models\Respuesta;

class PreguntaSeederPython extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leccionId = 21; // ⚡ Asegúrate de que es la prueba correcta

        $preguntas = [
            [
                'pregunta' => '¿Cómo se declara una variable en Python?',
                'opciones' => [
                    ['texto' => 'variable = valor', 'es_correcta' => true],
                    ['texto' => 'let variable = valor', 'es_correcta' => false],
                    ['texto' => 'var variable = valor', 'es_correcta' => false],
                    ['texto' => '$variable = valor', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué tipo de datos puede almacenar una variable en Python?',
                'opciones' => [
                    ['texto' => 'Números, cadenas, listas, diccionarios, etc.', 'es_correcta' => true],
                    ['texto' => 'Solo números y cadenas', 'es_correcta' => false],
                    ['texto' => 'Solo enteros', 'es_correcta' => false],
                    ['texto' => 'Solo listas', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Cuál es el valor por defecto de una variable sin asignar en Python?',
                'opciones' => [
                    ['texto' => 'No existe, produce un error.', 'es_correcta' => true],
                    ['texto' => 'None', 'es_correcta' => false],
                    ['texto' => '0', 'es_correcta' => false],
                    ['texto' => 'undefined', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué imprime print(type(3.14))?',
                'opciones' => [
                    ['texto' => "<class 'float'>", 'es_correcta' => true],
                    ['texto' => "<class 'decimal'>", 'es_correcta' => false],
                    ['texto' => "<class 'double'>", 'es_correcta' => false],
                    ['texto' => "<type 'float'>", 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué símbolo se usa para asignar valor a una variable en Python?',
                'opciones' => [
                    ['texto' => '=', 'es_correcta' => true],
                    ['texto' => '==', 'es_correcta' => false],
                    ['texto' => ':=', 'es_correcta' => false],
                    ['texto' => '=>', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué palabra clave se usa para declarar constantes en Python?',
                'opciones' => [
                    ['texto' => 'No hay palabra clave oficial, se usan mayúsculas por convención.', 'es_correcta' => true],
                    ['texto' => 'const', 'es_correcta' => false],
                    ['texto' => 'final', 'es_correcta' => false],
                    ['texto' => 'let', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué imprime print(type("Hola"))?',
                'opciones' => [
                    ['texto' => "<class 'str'>", 'es_correcta' => true],
                    ['texto' => "<class 'string'>", 'es_correcta' => false],
                    ['texto' => "<type 'str'>", 'es_correcta' => false],
                    ['texto' => "<string>", 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué significa None en Python?',
                'opciones' => [
                    ['texto' => 'Representa la ausencia de valor.', 'es_correcta' => true],
                    ['texto' => 'Es lo mismo que cero.', 'es_correcta' => false],
                    ['texto' => 'Es igual a una cadena vacía.', 'es_correcta' => false],
                    ['texto' => 'Indica un error.', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Cuál es el estilo de nombres recomendado para variables en Python?',
                'opciones' => [
                    ['texto' => 'snake_case', 'es_correcta' => true],
                    ['texto' => 'camelCase', 'es_correcta' => false],
                    ['texto' => 'PascalCase', 'es_correcta' => false],
                    ['texto' => 'SCREAMING_SNAKE_CASE', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué imprime print(2 + 3 * 4)?',
                'opciones' => [
                    ['texto' => '14', 'es_correcta' => true],
                    ['texto' => '20', 'es_correcta' => false],
                    ['texto' => '24', 'es_correcta' => false],
                    ['texto' => '9', 'es_correcta' => false],
                ]
            ],
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
