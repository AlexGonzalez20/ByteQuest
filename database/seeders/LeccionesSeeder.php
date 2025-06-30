<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeccionesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('lecciones')->insert([
            [
                'curso_id' => 1, // Asegúrate de que corresponde a tu curso de PHP
                'nombre' => 'Bienvenido a PHP',
                'descripcion' => '¡Bienvenido a PHP! En esta primera lección descubrirás qué es PHP, para qué se utiliza y por qué es tan popular para el desarrollo web. 
                Conocerás un poco de su historia, verás cómo instalar un entorno básico (XAMPP, MAMP o similar) y aprenderás a crear tu primer archivo PHP. 
                Tu reto será escribir tu primer "Hola Mundo" y entender cómo se ejecuta un script PHP en el navegador. Esta base es clave para sentirte cómodo con la sintaxis 
                y comenzar a programar con confianza.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 1,
                'nombre' => 'Variables y tipos de datos',
                'descripcion' => 'Las variables son el corazón de cualquier programa. Aquí aprenderás qué es una variable, cómo declararla, darle valor y cambiarlo. 
                Verás los tipos de datos más usados en PHP: strings, enteros, flotantes, booleanos y arrays. Además, practicarás ejemplos sencillos para manipular texto y números, 
                y entenderás la diferencia entre asignación y comparación. Prepárate para preguntas donde deberás identificar tipos de datos y corregir errores comunes al declarar variables.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 1,
                'nombre' => 'Operadores',
                'descripcion' => 'En esta lección conocerás cómo funcionan los operadores en PHP. Revisarás operadores aritméticos (suma, resta, multiplicación, división, módulo), 
                operadores de asignación, comparación (==, ===, !=) y lógicos (AND, OR, NOT). Entenderás cómo combinarlos para evaluar expresiones y resolver problemas simples. 
                Practicarás resolviendo preguntas de operaciones matemáticas básicas y evaluaciones lógicas que te ayudarán a reforzar la toma de decisiones en tus scripts.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 1,
                'nombre' => 'Condicionales',
                'descripcion' => 'Las estructuras condicionales te permiten que tu código tome decisiones. Aquí aprenderás a usar if, else, elseif y switch para manejar múltiples casos. 
                Estudiarás ejemplos prácticos como verificar la edad de un usuario, validar contraseñas o mostrar mensajes personalizados. Te prepararás para preguntas de escenarios reales, 
                donde deberás completar bloques condicionales o corregir errores en estructuras de decisión.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 1,
                'nombre' => 'Bucles',
                'descripcion' => 'Los bucles son fundamentales para repetir acciones de forma automática. En esta lección conocerás for, while y do...while. 
                Entenderás cuándo usar cada uno y cómo evitar errores como bucles infinitos. Practicarás con ejemplos como imprimir números del 1 al 10, recorrer listas de datos o sumar valores. 
                Prepárate para ejercicios que te pidan completar bucles y detectar fallos lógicos en su estructura.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 1,
                'nombre' => 'Funciones',
                'descripcion' => 'Las funciones te ayudan a organizar tu código en bloques reutilizables. Aprenderás a declarar funciones, pasarles parámetros y devolver resultados. 
                Verás ejemplos prácticos como una función para sumar números, validar datos o mostrar mensajes personalizados. Esta lección incluye buenas prácticas de nombres y ámbito de variables. 
                Responderás preguntas para identificar qué hace una función y corregir funciones incompletas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 1,
                'nombre' => 'Arreglos y listas',
                'descripcion' => 'Un arreglo es una estructura para guardar varios valores en una sola variable. Aprenderás a declarar arrays indexados y asociativos, agregar y eliminar elementos, 
                y recorrerlos con foreach. Practicarás ejercicios para acceder a elementos, modificar valores y trabajar con arrays multidimensionales. Las preguntas pondrán a prueba tu habilidad para leer 
                y escribir código que manipule listas de forma correcta.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 1,
                'nombre' => 'Manejo de errores',
                'descripcion' => 'Programar también significa aprender a identificar y corregir errores. Conocerás cómo usar try-catch para capturar excepciones y buenas prácticas para depurar tu código. 
                Practicarás interpretando mensajes de error típicos en PHP y solucionando fallos comunes como variables no definidas, divisiones por cero o errores de sintaxis. 
                Las preguntas de esta sección te entrenarán para encontrar errores en fragmentos de código.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 1,
                'nombre' => 'Mini proyecto',
                'descripcion' => 'Es momento de aplicar todo lo aprendido. Diseñarás un pequeño proyecto práctico, como un formulario de contacto, una calculadora o una lista de tareas. 
                Combinarás variables, operadores, condicionales, bucles, funciones y arrays. Esta lección es clave para reforzar tu confianza. Las preguntas finales te ayudarán a repasar cada concepto aplicado.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curso_id' => 1,
                'nombre' => 'Certificado + Logros',
                'descripcion' => '¡Felicitaciones por llegar hasta aquí! En esta última lección podrás repasar todos los conceptos vistos, validar tu conocimiento resolviendo un reto integrador y 
                desbloquear tu certificado digital. Además, conocerás consejos para seguir aprendiendo PHP y mejorar tus habilidades. Es el momento de sumar tus logros y compartirlos con orgullo.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
