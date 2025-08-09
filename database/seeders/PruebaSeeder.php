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
        $lecciones = Leccion::all();

        if ($lecciones->isEmpty()) {
            $this->command->warn('No hay lecciones. Crea una primero.');
            return;
        }

        foreach ($lecciones as $leccion) {
            for ($i = 1; $i <= 10; $i++) {
                Prueba::create([
                    'orden' => $i,
                    'xp' => 10 * $i,
                    'leccion_id' => $leccion->id,
                ]);
            }

        }

    }
}
