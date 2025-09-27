<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pregunta;
use App\Models\Respuesta;

class PHPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $leccionId = 2; // ⚡ Ajusta al ID de la lección/prueba que corresponda

        $preguntas = [
            [
                'pregunta' => '¿Cómo se declara un número en notación científica en PHP?',
                'opciones' => [
                    ['texto' => '1.2e3', 'es_correcta' => true],
                    ['texto' => '1.2E', 'es_correcta' => false],
                    ['texto' => '1,2e3', 'es_correcta' => false],
                    ['texto' => 'exp(1.2)', 'es_correcta' => false],
                ],
            ],
            [
                'pregunta' => '¿Cuál operador se usa para concatenar y asignar en PHP?',
                'opciones' => [
                    ['texto' => '.=', 'es_correcta' => true],
                    ['texto' => '+=', 'es_correcta' => false],
                    ['texto' => '&=', 'es_correcta' => false],
                    ['texto' => '::=', 'es_correcta' => false],
                ],
            ],
            [
                'pregunta' => '¿Qué operador se utiliza para obtener el módulo (resto) de una división?',
                'opciones' => [
                    ['texto' => '%', 'es_correcta' => true],
                    ['texto' => '/', 'es_correcta' => false],
                    ['texto' => 'mod', 'es_correcta' => false],
                    ['texto' => '//', 'es_correcta' => false],
                ],
            ],
            [
                'pregunta' => '¿Cómo se define un valor nulo en PHP?',
                'opciones' => [
                    ['texto' => 'null', 'es_correcta' => true],
                    ['texto' => 'NULL()', 'es_correcta' => false],
                    ['texto' => '0', 'es_correcta' => false],
                    ['texto' => 'empty', 'es_correcta' => false],
                ],
            ],
            [
                'pregunta' => '¿Qué operador compara solo el valor, ignorando el tipo?',
                'opciones' => [
                    ['texto' => '==', 'es_correcta' => true],
                    ['texto' => '===', 'es_correcta' => false],
                    ['texto' => '!=', 'es_correcta' => false],
                    ['texto' => '<>', 'es_correcta' => false],
                ],
            ],
            [
                'pregunta' => '¿Qué operador se usa para incrementar una variable en 2 unidades?',
                'opciones' => [
                    ['texto' => '+= 2', 'es_correcta' => true],
                    ['texto' => '++2', 'es_correcta' => false],
                    ['texto' => '*= 2', 'es_correcta' => false],
                    ['texto' => '++', 'es_correcta' => false],
                ],
            ],
            [
                'pregunta' => '¿Qué operador devuelve verdadero si ambos operandos son falsos?',
                'opciones' => [
                    ['texto' => '!', 'es_correcta' => true],
                    ['texto' => '&&', 'es_correcta' => false],
                    ['texto' => '||', 'es_correcta' => false],
                    ['texto' => 'xor', 'es_correcta' => false],
                ],
            ],
            [
                'pregunta' => '¿Cómo se representa un número hexadecimal en PHP?',
                'opciones' => [
                    ['texto' => '0x1A', 'es_correcta' => true],
                    ['texto' => '1Ah', 'es_correcta' => false],
                    ['texto' => '#1A', 'es_correcta' => false],
                    ['texto' => '0h1A', 'es_correcta' => false],
                ],
            ],
            [
                'pregunta' => '¿Cuál operador lógico devuelve verdadero solo si uno de los operandos es verdadero, pero no ambos?',
                'opciones' => [
                    ['texto' => 'xor', 'es_correcta' => true],
                    ['texto' => '&&', 'es_correcta' => false],
                    ['texto' => '||', 'es_correcta' => false],
                    ['texto' => '!', 'es_correcta' => false],
                ],
            ],
            [
                'pregunta' => '¿Qué tipo de dato se usa para cadenas multilínea en PHP?',
                'opciones' => [
                    ['texto' => 'heredoc', 'es_correcta' => true],
                    ['texto' => 'string', 'es_correcta' => false],
                    ['texto' => 'array', 'es_correcta' => false],
                    ['texto' => 'textblock', 'es_correcta' => false],
                ],
            ],
            [
                'pregunta' => '¿Cómo se convierte un valor a booleano en PHP?',
                'opciones' => [
                    ['texto' => '(bool)$var', 'es_correcta' => true],
                    ['texto' => 'boolval($var)', 'es_correcta' => false],
                    ['texto' => 'toBoolean($var)', 'es_correcta' => false],
                    ['texto' => 'setBool($var)', 'es_correcta' => false],
                ],
            ],
            [
                'pregunta' => '¿Cuál operador bit a bit invierte los bits de un número?',
                'opciones' => [
                    ['texto' => '~', 'es_correcta' => true],
                    ['texto' => '&', 'es_correcta' => false],
                    ['texto' => '|', 'es_correcta' => false],
                    ['texto' => '^', 'es_correcta' => false],
                ],
            ],
            [
                'pregunta' => '¿Qué operador devuelve verdadero si al menos uno de los operandos es verdadero?',
                'opciones' => [
                    ['texto' => '||', 'es_correcta' => true],
                    ['texto' => '&&', 'es_correcta' => false],
                    ['texto' => 'xor', 'es_correcta' => false],
                    ['texto' => '!', 'es_correcta' => false],
                ],
            ],
            [
                'pregunta' => '¿Cómo se declara un array vacío en PHP?',
                'opciones' => [
                    ['texto' => '[]', 'es_correcta' => true],
                    ['texto' => 'array()', 'es_correcta' => false],
                    ['texto' => '()', 'es_correcta' => false],
                    ['texto' => '{}', 'es_correcta' => false],
                ],
            ],
            [
                'pregunta' => '¿Qué operador compara desigualdad de valor y tipo?',
                'opciones' => [
                    ['texto' => '!==', 'es_correcta' => true],
                    ['texto' => '!=', 'es_correcta' => false],
                    ['texto' => '<>', 'es_correcta' => false],
                    ['texto' => '==', 'es_correcta' => false],
                ],
            ],
            [
                'pregunta' => '¿Qué tipo de dato se utiliza para colecciones de valores indexados?',
                'opciones' => [
                    ['texto' => 'array', 'es_correcta' => true],
                    ['texto' => 'string', 'es_correcta' => false],
                    ['texto' => 'object', 'es_correcta' => false],
                    ['texto' => 'integer', 'es_correcta' => false],
                ],
            ],
            [
                'pregunta' => '¿Qué operador asigna el valor de la derecha al de la izquierda?',
                'opciones' => [
                    ['texto' => '=', 'es_correcta' => true],
                    ['texto' => '=>', 'es_correcta' => false],
                    ['texto' => '==', 'es_correcta' => false],
                    ['texto' => '===', 'es_correcta' => false],
                ],
            ],
            [
                'pregunta' => '¿Qué operador se usa para el AND lógico en forma alternativa en PHP?',
                'opciones' => [
                    ['texto' => 'and', 'es_correcta' => true],
                    ['texto' => '&&', 'es_correcta' => false],
                    ['texto' => '||', 'es_correcta' => false],
                    ['texto' => '&', 'es_correcta' => false],
                ],
            ],
            [
                'pregunta' => '¿Qué operador se usa para restar en PHP?',
                'opciones' => [
                    ['texto' => '-', 'es_correcta' => true],
                    ['texto' => '+', 'es_correcta' => false],
                    ['texto' => '*', 'es_correcta' => false],
                    ['texto' => '/', 'es_correcta' => false],
                ],
            ],
            [
                'pregunta' => '¿Qué operador se usa para multiplicar en PHP?',
                'opciones' => [
                    ['texto' => '*', 'es_correcta' => true],
                    ['texto' => '+', 'es_correcta' => false],
                    ['texto' => '-', 'es_correcta' => false],
                    ['texto' => '/', 'es_correcta' => false],
                ],
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
