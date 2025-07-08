<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeccionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lecciones')->insert([
            [
                'curso_id' => 1, // Cambia por el ID real de tu curso PHP
                'nombre' => '1. Introducción y Variables',
                'descripcion' => 'Aprende qué es PHP, cómo funciona, y domina la declaración y uso de variables para almacenar y manipular datos básicos.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 1,
                'nombre' => '2. Tipos de Datos y Operadores',
                'descripcion' => 'Explora los tipos de datos en PHP: strings, números, booleanos y cómo combinarlos con operadores aritméticos y lógicos.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 1,
                'nombre' => '3. Estructuras de Control',
                'descripcion' => 'Aprende a usar condicionales (if, else) y bucles (for, while) para controlar el flujo de tus programas PHP.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 1,
                'nombre' => '4. Funciones Básicas',
                'descripcion' => 'Define y usa funciones para organizar tu código y reutilizar bloques lógicos de forma eficiente.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 1,
                'nombre' => '5. Arreglos (Arrays)',
                'descripcion' => 'Trabaja con arrays para almacenar múltiples valores y manipular listas de datos en PHP.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 1,
                'nombre' => '6. Strings y Manipulación de Texto',
                'descripcion' => 'Aprende a manipular cadenas de texto con funciones integradas de PHP para crear mensajes dinámicos.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 1,
                'nombre' => '7. Formularios y Datos del Usuario',
                'descripcion' => 'Envía y recibe datos de formularios HTML, procesa entradas del usuario de forma segura.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 1,
                'nombre' => '8. Manejo de Errores',
                'descripcion' => 'Identifica y corrige errores comunes, implementa manejo básico de excepciones.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 1,
                'nombre' => '9. Buenas Prácticas',
                'descripcion' => 'Aprende prácticas recomendadas para escribir código limpio, organizado y fácil de mantener.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 1,
                'nombre' => '10. Repaso y Nivel de Dominio',
                'descripcion' => 'Repasa todos los conceptos clave a través de preguntas mezcladas y mini retos para afianzar tus conocimientos.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 2, // Cambia por el ID real de tu curso PHP
                'nombre' => '1. Introducción y Variables',
                'descripcion' => 'Aprende qué es PHP, cómo funciona, y domina la declaración y uso de variables para almacenar y manipular datos básicos.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 2,
                'nombre' => '2. Tipos de Datos y Operadores',
                'descripcion' => 'Explora los tipos de datos en PHP: strings, números, booleanos y cómo combinarlos con operadores aritméticos y lógicos.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 2,
                'nombre' => '3. Estructuras de Control',
                'descripcion' => 'Aprende a usar condicionales (if, else) y bucles (for, while) para controlar el flujo de tus programas PHP.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 2,
                'nombre' => '4. Funciones Básicas',
                'descripcion' => 'Define y usa funciones para organizar tu código y reutilizar bloques lógicos de forma eficiente.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 2,
                'nombre' => '5. Arreglos (Arrays)',
                'descripcion' => 'Trabaja con arrays para almacenar múltiples valores y manipular listas de datos en PHP.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 2,
                'nombre' => '6. Strings y Manipulación de Texto',
                'descripcion' => 'Aprende a manipular cadenas de texto con funciones integradas de PHP para crear mensajes dinámicos.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 2,
                'nombre' => '7. Formularios y Datos del Usuario',
                'descripcion' => 'Envía y recibe datos de formularios HTML, procesa entradas del usuario de forma segura.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 2,
                'nombre' => '8. Manejo de Errores',
                'descripcion' => 'Identifica y corrige errores comunes, implementa manejo básico de excepciones.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 2,
                'nombre' => '9. Buenas Prácticas',
                'descripcion' => 'Aprende prácticas recomendadas para escribir código limpio, organizado y fácil de mantener.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 2,
                'nombre' => '10. Repaso y Nivel de Dominio',
                'descripcion' => 'Repasa todos los conceptos clave a través de preguntas mezcladas y mini retos para afianzar tus conocimientos.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
             [
                'curso_id' => 3, // Cambia por el ID real de tu curso PHP
                'nombre' => '1. Introducción y Variables',
                'descripcion' => 'Aprende qué es PHP, cómo funciona, y domina la declaración y uso de variables para almacenar y manipular datos básicos.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 3,
                'nombre' => '2. Tipos de Datos y Operadores',
                'descripcion' => 'Explora los tipos de datos en PHP: strings, números, booleanos y cómo combinarlos con operadores aritméticos y lógicos.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 3,
                'nombre' => '3. Estructuras de Control',
                'descripcion' => 'Aprende a usar condicionales (if, else) y bucles (for, while) para controlar el flujo de tus programas PHP.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 3,
                'nombre' => '4. Funciones Básicas',
                'descripcion' => 'Define y usa funciones para organizar tu código y reutilizar bloques lógicos de forma eficiente.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 3,
                'nombre' => '5. Arreglos (Arrays)',
                'descripcion' => 'Trabaja con arrays para almacenar múltiples valores y manipular listas de datos en PHP.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 3,
                'nombre' => '6. Strings y Manipulación de Texto',
                'descripcion' => 'Aprende a manipular cadenas de texto con funciones integradas de PHP para crear mensajes dinámicos.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 3,
                'nombre' => '7. Formularios y Datos del Usuario',
                'descripcion' => 'Envía y recibe datos de formularios HTML, procesa entradas del usuario de forma segura.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 3,
                'nombre' => '8. Manejo de Errores',
                'descripcion' => 'Identifica y corrige errores comunes, implementa manejo básico de excepciones.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 3,
                'nombre' => '9. Buenas Prácticas',
                'descripcion' => 'Aprende prácticas recomendadas para escribir código limpio, organizado y fácil de mantener.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 3,
                'nombre' => '10. Repaso y Nivel de Dominio',
                'descripcion' => 'Repasa todos los conceptos clave a través de preguntas mezcladas y mini retos para afianzar tus conocimientos.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
