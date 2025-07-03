<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pregunta;
use App\Models\Respuesta;

class PreguntaSeeder extends Seeder
{
    public function run(): void
    {
        $leccionId = 1; // ⚡ Asegúrate de que es la prueba correcta

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
                'pregunta' => '¿Cuál es la forma correcta de asignar un valor?',
                'opciones' => [
                    ['texto' => '$x = 10;', 'es_correcta' => true],
                    ['texto' => 'x := 10;', 'es_correcta' => false],
                    ['texto' => 'int x = 10;', 'es_correcta' => false],
                    ['texto' => 'let $x = 10;', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué símbolo se usa para concatenar en PHP?',
                'opciones' => [
                    ['texto' => '.', 'es_correcta' => true],
                    ['texto' => '+', 'es_correcta' => false],
                    ['texto' => '&', 'es_correcta' => false],
                    ['texto' => '||', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Cómo se imprime texto en PHP?',
                'opciones' => [
                    ['texto' => 'echo', 'es_correcta' => true],
                    ['texto' => 'print()', 'es_correcta' => false],
                    ['texto' => 'console.log()', 'es_correcta' => false],
                    ['texto' => 'printf', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué extensión tienen los archivos PHP?',
                'opciones' => [
                    ['texto' => '.php', 'es_correcta' => true],
                    ['texto' => '.html', 'es_correcta' => false],
                    ['texto' => '.js', 'es_correcta' => false],
                    ['texto' => '.py', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué función devuelve la longitud de una string?',
                'opciones' => [
                    ['texto' => 'strlen()', 'es_correcta' => true],
                    ['texto' => 'count()', 'es_correcta' => false],
                    ['texto' => 'length()', 'es_correcta' => false],
                    ['texto' => 'sizeof()', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Cómo se crea un array?',
                'opciones' => [
                    ['texto' => 'array()', 'es_correcta' => true],
                    ['texto' => 'new Array()', 'es_correcta' => false],
                    ['texto' => '[]', 'es_correcta' => false],
                    ['texto' => '{}', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué estructura de control existe en PHP?',
                'opciones' => [
                    ['texto' => 'if', 'es_correcta' => true],
                    ['texto' => 'when', 'es_correcta' => false],
                    ['texto' => 'match', 'es_correcta' => false],
                    ['texto' => 'select', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué función convierte string a entero?',
                'opciones' => [
                    ['texto' => 'intval()', 'es_correcta' => true],
                    ['texto' => 'parseInt()', 'es_correcta' => false],
                    ['texto' => 'toInt()', 'es_correcta' => false],
                    ['texto' => 'convert()', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué operador compara valor y tipo?',
                'opciones' => [
                    ['texto' => '===', 'es_correcta' => true],
                    ['texto' => '==', 'es_correcta' => false],
                    ['texto' => '=', 'es_correcta' => false],
                    ['texto' => '!=', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué palabra clave define una función?',
                'opciones' => [
                    ['texto' => 'function', 'es_correcta' => true],
                    ['texto' => 'func', 'es_correcta' => false],
                    ['texto' => 'def', 'es_correcta' => false],
                    ['texto' => 'method', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué palabra se usa para clases?',
                'opciones' => [
                    ['texto' => 'class', 'es_correcta' => true],
                    ['texto' => 'object', 'es_correcta' => false],
                    ['texto' => 'new', 'es_correcta' => false],
                    ['texto' => 'define', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué operador lógico es “y”?',
                'opciones' => [
                    ['texto' => '&&', 'es_correcta' => true],
                    ['texto' => '||', 'es_correcta' => false],
                    ['texto' => '!', 'es_correcta' => false],
                    ['texto' => '&', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué operador lógico es “o”?',
                'opciones' => [
                    ['texto' => '||', 'es_correcta' => true],
                    ['texto' => '&&', 'es_correcta' => false],
                    ['texto' => '!', 'es_correcta' => false],
                    ['texto' => '|', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Cómo declarar constante?',
                'opciones' => [
                    ['texto' => 'define()', 'es_correcta' => true],
                    ['texto' => 'const', 'es_correcta' => false],
                    ['texto' => 'constant()', 'es_correcta' => false],
                    ['texto' => 'let', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Cómo se declara array asociativo?',
                'opciones' => [
                    ['texto' => '["key" => "value"]', 'es_correcta' => true],
                    ['texto' => '{"key":"value"}', 'es_correcta' => false],
                    ['texto' => '{key: value}', 'es_correcta' => false],
                    ['texto' => 'new Map()', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Cómo iterar array?',
                'opciones' => [
                    ['texto' => 'foreach', 'es_correcta' => true],
                    ['texto' => 'forEach()', 'es_correcta' => false],
                    ['texto' => 'map()', 'es_correcta' => false],
                    ['texto' => 'loop', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué hace require_once?',
                'opciones' => [
                    ['texto' => 'Incluye archivo una vez', 'es_correcta' => true],
                    ['texto' => 'Ejecuta script', 'es_correcta' => false],
                    ['texto' => 'Compila código', 'es_correcta' => false],
                    ['texto' => 'Requiere usuario', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué hace include?',
                'opciones' => [
                    ['texto' => 'Incluye archivo', 'es_correcta' => true],
                    ['texto' => 'Ejecuta base de datos', 'es_correcta' => false],
                    ['texto' => 'Valida usuario', 'es_correcta' => false],
                    ['texto' => 'Instala librería', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué extensión tiene composer?',
                'opciones' => [
                    ['texto' => 'composer.json', 'es_correcta' => true],
                    ['texto' => 'package.json', 'es_correcta' => false],
                    ['texto' => 'composer.lock', 'es_correcta' => false],
                    ['texto' => 'composer.php', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué hace namespace?',
                'opciones' => [
                    ['texto' => 'Organiza código', 'es_correcta' => true],
                    ['texto' => 'Cierra sesión', 'es_correcta' => false],
                    ['texto' => 'Exporta clase', 'es_correcta' => false],
                    ['texto' => 'Define ruta', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Qué significa PDO?',
                'opciones' => [
                    ['texto' => 'PHP Data Objects', 'es_correcta' => true],
                    ['texto' => 'Personal Data Object', 'es_correcta' => false],
                    ['texto' => 'Program Data Object', 'es_correcta' => false],
                    ['texto' => 'Post Data Output', 'es_correcta' => false],
                ]
            ],
            [
                'pregunta' => '¿Cómo se abre bloque PHP?',
                'opciones' => [
                    ['texto' => '<?php', 'es_correcta' => true],
                    ['texto' => '<php>', 'es_correcta' => false],
                    ['texto' => '<?', 'es_correcta' => false],
                    ['texto' => '<?=', 'es_correcta' => false],
                ]
            ],
        ];

        foreach ($preguntas as $q) {
            $pregunta = Pregunta::create([
                'leccion_id' => $leccionId,
                'pregunta' => $q['pregunta'],
                'imagen' => null,
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
