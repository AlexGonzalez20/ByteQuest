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
        // 1️⃣ Crea o actualiza usuario John Doe
        $usuario = Usuario::updateOrCreate(
            ['email' => 'john@example.com'],
            [
                'nombre'       => 'John',
                'apellido'     => 'Doe',
                'password'     => Hash::make('12345678'),
                'vidas'        => 5,
                'experiencia'  => 100,
                // Añade 'role_id' si corresponde a tu esquema de roles
            ]
        );

        // 2️⃣ Busca el curso con ID 1 (asegúrate de tenerlo)
        $curso = Curso::findOrFail(1);

        // 3️⃣ Busca la primera lección y prueba del curso
        $primeraLeccion = $curso->lecciones()->orderBy('id')->first();
        $primeraPrueba  = $primeraLeccion ? $primeraLeccion->pruebas()->orderBy('orden')->first() : null;

        // 4️⃣ Asigna John Doe al curso ID 1 con progreso inicial y racha de 5 días
        $usuario->cursos()->syncWithoutDetaching([
            $curso->id => [
                'leccion_actual_id' => $primeraLeccion ? $primeraLeccion->id : null,
                'prueba_actual_id'  => $primeraPrueba ? $primeraPrueba->id : null,
                'created_at'        => now()->subDays(5), // Simula que empezó hace 5 días
                'updated_at'        => now(),
                // Si tienes columna 'racha' en la tabla pivote, descomenta:
                // 'racha' => 5,
            ],
        ]);

        $this->command->info("✅ John Doe creado con email john@example.com y asignado al curso ID 1: '{$curso->nombre}'");
    }
}
