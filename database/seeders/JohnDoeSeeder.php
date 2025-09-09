<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Curso;
use Illuminate\Support\Facades\Hash;

class JohnDoeSeeder extends Seeder
{
    public function run()
    {
        // Lista de cursos disponibles
        $cursos = Curso::whereIn('nombre', ['PHP', 'JavaScript', 'Python'])->get();

        // Datos base para generar usuarios ficticios
        $nombres = [
            ['John', 'Doe'],
            ['Jane', 'Smith'],
            ['Carlos', 'Pérez'],
            ['Ana', 'Gómez'],
            ['Luis', 'Martínez'],
            ['Sofía', 'Ramírez'],
            ['Pedro', 'López'],
            ['María', 'Torres'],
            ['Andrés', 'Jiménez'],
            ['Lucía', 'Fernández'],
            ['Miguel', 'Castro'],
            ['Camila', 'Morales'],
            ['Jorge', 'Suárez'],
            ['Valentina', 'Córdoba'],
            ['Felipe', 'Ortega'],
        ];

        foreach ($nombres as [$nombre, $apellido]) {
            $email = strtolower($nombre) . "." . strtolower($apellido) . "@example.com";

            // Crear o actualizar usuario
            $usuario = Usuario::updateOrCreate(
                ['email' => $email],
                [
                    'nombre'      => $nombre,
                    'apellido'    => $apellido,
                    'password'    => Hash::make('12345678'),
                    'vidas'       => rand(2, 5),
                    'experiencia' => rand(50, 500),
                ]
            );

            // Seleccionar aleatoriamente en qué cursos estará inscrito
            $cursosAleatorios = $cursos->random(rand(1, $cursos->count()));

            foreach ($cursosAleatorios as $curso) {
                $primeraLeccion = $curso->lecciones()->orderBy('id')->first();
                $primeraPrueba  = $primeraLeccion ? $primeraLeccion->pruebas()->orderBy('orden')->first() : null;

                $usuario->cursos()->syncWithoutDetaching([
                    $curso->id => [
                        'leccion_actual_id' => $primeraLeccion ? $primeraLeccion->id : null,
                        'prueba_actual_id'  => $primeraPrueba ? $primeraPrueba->id : null,
                        'created_at'        => now()->subDays(rand(1, 10)),
                        'updated_at'        => now(),
                        // 'racha' => rand(1, 7), // si existe columna racha
                    ],
                ]);

                $this->command->info("✅ {$usuario->nombre} {$usuario->apellido} inscrito en el curso '{$curso->nombre}'");
            }
        }
    }
}
