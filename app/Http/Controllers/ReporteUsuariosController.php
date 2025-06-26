<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Barryvdh\DomPDF\Facade\Pdf;  // si vas a PDF
use Illuminate\Http\Request;

class ReporteUsuariosController extends Controller
{
    /**
     * Mostrar la vista con conteo de usuarios por curso.
     */
    public function index()
    {
        // Trae todos los cursos con su conteo de usuarios
        $cursos = Curso::withCount('usuarios')->get();

        return view('reportes.usuarios_por_curso', compact('cursos'));
    }

    /**
     * Generar y descargar PDF del mismo reporte.
     */
    public function descargarPdf()
    {
        $cursos = Curso::withCount('usuarios')->get();

        $pdf = Pdf::loadView('reportes.usuarios_por_curso', compact('cursos'));
        return $pdf->download('reporte_usuarios_por_curso.pdf');
    }
}
