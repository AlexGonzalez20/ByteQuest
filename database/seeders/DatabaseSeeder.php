<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Usuario::firstOrCreate(
            [
                'email' => 'admin@gmail.com'
            ],
            [
                'nombre' => 'Admin',
                'apellido' => 'ByteQuest',
                'password' => Hash::make('Prueba123!'),
                'rol_id' => 2
            ]
        );

        Usuario::firstOrCreate(
            [
                'email' => 'usuarioprueba@gmail.com'
            ],
            [
                'nombre' => 'usuarioprueba',
                'apellido' => 'prueba',
                'password' => Hash::make('Prueba123!'), // Contraseña segura de ejemplo
                'rol_id' => 1
            ]
        );
        Usuario::factory()->count(100)->create();
        $this->call(CursosSeeder::class);
        $this->call(LeccionesSeeder::class);
        $this->call(PreguntaSeeder::class);
    }
}
