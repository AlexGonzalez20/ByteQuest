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
    $json = file_get_contents(database_path('seeders/lecciones.json'));
    $data = json_decode($json, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        dd(json_last_error_msg());
    }

    $insertData = [];
    foreach ($data as $leccion) {
    $insertData[] = [
        'nombre' => $leccion['nombre'] ?? null,
        'descripcion' => $leccion['descripcion'] ?? null,
        'contenido' => isset($leccion['contenido']) ? json_encode($leccion['contenido']) : null,
        'curso_id' => $leccion['curso_id'] ?? null,
        'created_at' => isset($leccion['created_at']) ? date('Y-m-d H:i:s', strtotime($leccion['created_at'])) : now(),
        'updated_at' => isset($leccion['updated_at']) ? date('Y-m-d H:i:s', strtotime($leccion['updated_at'])) : now(),
    ];
}
DB::table('lecciones')->insert($insertData);

}}
        


