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
                'descripcion' => '¡Bienvenido al curso de PHP de ByteQuest!

PHP es uno de los lenguajes de programación más utilizados en el desarrollo web. Gracias a su facilidad de uso y gran compatibilidad con bases de datos, PHP impulsa millones de sitios y plataformas dinámicas alrededor del mundo.

En este curso aprenderás desde lo más básico: entenderás la sintaxis, variables, operadores, estructuras de control, funciones y cómo PHP se integra con HTML para crear páginas dinámicas. También verás cómo trabajar con formularios, sesiones y bases de datos MySQL para construir aplicaciones web completas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'JavaScript',
                'descripcion' => 'Bienvenido al curso de JavaScript de ByteQuest!

JavaScript es el lenguaje clave para darle interactividad y dinamismo a cualquier sitio web. Es uno de los lenguajes más demandados en el mundo del desarrollo frontend y backend gracias a su versatilidad y potencia.

En este curso descubrirás desde lo esencial: variables, tipos de datos, operadores, funciones, estructuras de control y manipulación del DOM para interactuar directamente con el contenido de una página. También tendrás una introducción a temas como eventos, asincronía y buenas prácticas modernas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Python',
                'descripcion' => '¡Bienvenido al curso de Python de ByteQuest!

En este recorrido aprenderás uno de los lenguajes de programación más populares y versátiles del mundo. Python es conocido por su sintaxis clara, simple y amigable para quienes se inician en el mundo del código.

Durante este curso explorarás desde los conceptos más básicos —como variables, tipos de datos, operadores y estructuras de control— hasta temas más avanzados como funciones, manejo de archivos y programación orientada a objetos.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
