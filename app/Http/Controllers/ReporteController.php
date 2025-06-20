<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;

class ReporteController extends Controller
{
    use App\Models\Curso;

public function reporteCursos()
{
    // 
   
{
    $cursos = Curso::with('usuarios')->name(); 
        return view('reporte.cursos', compact('cursos'));
}

}

}
