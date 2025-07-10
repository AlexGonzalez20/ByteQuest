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

        foreach ($data as &$leccion) {
    unset($leccion['id']);
            $leccion['created_at'] = now();
            $leccion['updated_at'] = now();
        }

        DB::table('lecciones')->insert($data);
    }
}
        


