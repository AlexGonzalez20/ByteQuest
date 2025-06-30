<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pregunta;

class PreguntaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pregunta 1: PHP básico
        $pregunta1 = Pregunta::create([
            'leccion_id' => 1, // Asegúrate que la Lección 1 exista y trate sobre variables
            'pregunta' => '¿Cuál es el símbolo para declarar una variable en PHP?',
            'imagen' => null,
        ]);

        $pregunta1->respuestas()->createMany([
            ['texto_opcion' => '$', 'es_correcta' => true],
            ['texto_opcion' => '#', 'es_correcta' => false],
            ['texto_opcion' => '&', 'es_correcta' => false],
            ['texto_opcion' => '@', 'es_correcta' => false],
        ]);

        // Pregunta 2: JavaScript básico
        $pregunta2 = Pregunta::create([
            'leccion_id' => 1,
            'pregunta' => '¿Cuál de estas palabras clave se usa para declarar una variable en JavaScript?',
            'imagen' => null,
        ]);

        $pregunta2->respuestas()->createMany([
            ['texto_opcion' => 'define', 'es_correcta' => false],
            ['texto_opcion' => 'var', 'es_correcta' => true],
            ['texto_opcion' => 'int', 'es_correcta' => false],
            ['texto_opcion' => 'const variable', 'es_correcta' => false],
        ]);

        // Pregunta 3: Concepto general de variables
        $pregunta3 = Pregunta::create([
            'leccion_id' => 1,
            'pregunta' => '¿Qué es una variable en programación?',
            'imagen' => null,
        ]);

        $pregunta3->respuestas()->createMany([
            ['texto_opcion' => 'Una constante que no cambia su valor', 'es_correcta' => false],
            ['texto_opcion' => 'Una forma de mostrar texto en pantalla', 'es_correcta' => false],
            ['texto_opcion' => 'Un espacio de memoria para guardar un dato', 'es_correcta' => true],
            ['texto_opcion' => 'Una instrucción para detener el programa', 'es_correcta' => false],
        ]);
    }
}
