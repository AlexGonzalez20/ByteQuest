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
                'pregunta' => '¿Cómo se declara una variable usando ES6 en JavaScript?',
                'opciones' => [
                    ['texto' => 'let nombre;', 'es_correcta' => true],
                    ['texto' => 'var nombre;', 'es_correcta' => false],
                    ['texto' => 'const nombre;', 'es_correcta' => false],
                    ['texto' => 'int nombre;', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué palabra clave se usaba tradicionalmente para declarar variables en JavaScript?',
                'opciones' => [
                    ['texto' => 'var', 'es_correcta' => true],
                    ['texto' => 'let', 'es_correcta' => false],
                    ['texto' => 'const', 'es_correcta' => false],
                    ['texto' => 'int', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué palabra clave se usa para declarar una constante?',
                'opciones' => [
                    ['texto' => 'const', 'es_correcta' => true],
                    ['texto' => 'let', 'es_correcta' => false],
                    ['texto' => 'var', 'es_correcta' => false],
                    ['texto' => 'constant', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué tipo de datos puede almacenar una variable en JavaScript?',
                'opciones' => [
                    ['texto' => 'Cualquier tipo: números, cadenas, booleanos, objetos, etc.', 'es_correcta' => true],
                    ['texto' => 'Solo números y cadenas', 'es_correcta' => false],
                    ['texto' => 'Solo objetos', 'es_correcta' => false],
                    ['texto' => 'Solo números', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué imprime console.log(typeof 123)?',
                'opciones' => [
                    ['texto' => '"number"', 'es_correcta' => true],
                    ['texto' => '"Number"', 'es_correcta' => false],
                    ['texto' => '"int"', 'es_correcta' => false],
                    ['texto' => '"integer"', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Cuál es el valor predeterminado de una variable declarada pero no inicializada?',
                'opciones' => [
                    ['texto' => 'undefined', 'es_correcta' => true],
                    ['texto' => 'null', 'es_correcta' => false],
                    ['texto' => '0', 'es_correcta' => false],
                    ['texto' => 'NaN', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué operador se usa para asignar un valor a una variable?',
                'opciones' => [
                    ['texto' => '=', 'es_correcta' => true],
                    ['texto' => '==', 'es_correcta' => false],
                    ['texto' => '===', 'es_correcta' => false],
                    ['texto' => ':=', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué palabra clave permite reasignar el valor de la variable declarada?',
                'opciones' => [
                    ['texto' => 'let', 'es_correcta' => true],
                    ['texto' => 'const', 'es_correcta' => false],
                    ['texto' => 'define', 'es_correcta' => false],
                    ['texto' => 'fixed', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué sucede si intentas cambiar el valor de una constante?',
                'opciones' => [
                    ['texto' => 'JavaScript lanza un error.', 'es_correcta' => true],
                    ['texto' => 'El valor cambia sin problemas.', 'es_correcta' => false],
                    ['texto' => 'Se convierte en variable.', 'es_correcta' => false],
                    ['texto' => 'No pasa nada.', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Cuál es la forma correcta de concatenar cadenas en JavaScript?',
                'opciones' => [
                    ['texto' => '"Hola " + nombre', 'es_correcta' => true],
                    ['texto' => '"Hola ".concat(nombre)', 'es_correcta' => false],
                    ['texto' => '"Hola ", nombre', 'es_correcta' => false],
                    ['texto' => 'concat("Hola ", nombre)', 'es_correcta' => false],
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
