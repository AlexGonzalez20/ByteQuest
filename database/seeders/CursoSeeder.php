<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  public function run(): void
  {

$json = file_get_contents(database_path('seeders/curso.json'));
$data = json_decode($json, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
    dd(json_last_error_msg());
    }
 foreach ($data as $curso) {
    unset($curso['id']);
    // Convertir fechas ISO 8601 a formato MySQL
    if (isset($curso['created_at'])) {
        $curso['created_at'] = date('Y-m-d H:i:s', strtotime($curso['created_at']));
    }
    if (isset($curso['updated_at'])) {
        $curso['updated_at'] = date('Y-m-d H:i:s', strtotime($curso['updated_at']));
    }
    // Solo inserta si no existe el nombre
    if (!DB::table('cursos')->where('nombre', $curso['nombre'])->exists()) {
        DB::table('cursos')->insert($curso);
    }
}
}}