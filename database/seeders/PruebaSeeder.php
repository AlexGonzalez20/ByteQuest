<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prueba;
use App\Models\Leccion;

class PruebaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener la primera lección
        $leccion = Leccion::first();

        if (!$leccion) {
            $this->command->warn('No hay lecciones. Crea una primero.');
            return;
        }

        // Crear 10 pruebas para esa lección
        for ($i = 1; $i <= 10; $i++) {
            Prueba::create([
                'orden' => $i,
                'xp' => 10 * $i,
                'leccion_id' => $leccion->id,
            ]);
        }

        $this->command->info('10 pruebas creadas para la lección con ID: ' . $leccion->id);
    }
}
