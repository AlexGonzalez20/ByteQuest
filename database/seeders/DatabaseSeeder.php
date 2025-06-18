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
                'email' => 'admin@bytequest.com'
            ],
            [
                'nombre' => 'Admin',
                'apellido' => 'ByteQuest',
                'password' => Hash::make('12345678'),
                'rol_id' => 2

            ]
        );

        $this->call(\Database\Seeders\CursoPreguntaOpcionSeeder::class);
    }
}