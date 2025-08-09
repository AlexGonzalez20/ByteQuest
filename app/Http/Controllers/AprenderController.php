<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Prueba;
use Illuminate\Http\Request;

class AprenderController extends Controller
{
    public function index()
    {
        $ruta = database_path('json/leccionAprender.json');

    if (!file_exists($ruta)) {
        abort(404, 'Archivo no encontrado');
    }

    $datos = json_decode(file_get_contents($ruta), true);
        $pruebas = Prueba::with('leccion')->orderBy('leccion_id')->orderBy('orden')->get();
        $cursos = Curso::all();
        return view('VistasEstudiante.aprender', compact('cursos', 'pruebas', 'datos'));
    }
}
