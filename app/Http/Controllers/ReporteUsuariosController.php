<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReporteUsuariosController extends Controller
{
    /**
     * Mostrar la vista del reporte en navegador.
     */
    public function index()
    {
        $cursos = Curso::with([
            'usuarios:id,nombre,apellido,email,experiencia' // 👈 Traemos solo los campos necesarios
        ])->withCount('usuarios')->get();

        $usuario = auth()->user()->nombre;
        $fechaGeneracion = Carbon::now('America/Bogota')->format('d/m/Y H:i');

        return view('reportes.usuariosPorCurso', [
            'cursos' => $cursos,
            'usuario' => $usuario,
            'fechaGeneracion' => $fechaGeneracion,
            'isPdf' => false
        ]);
    }

    /**
     * Generar y descargar PDF del reporte.
     */
    public function descargarPdf()
    {
        $cursos = Curso::with([
            'usuarios:id,nombre,apellido,email,experiencia'
        ])->withCount('usuarios')->get();

        $usuario = auth()->user()->nombre;
        $fechaGeneracion = Carbon::now('America/Bogota')->format('d/m/Y H:i');

        $pdf = Pdf::loadView('reportes.usuariosPorCurso', [
            'cursos' => $cursos,
            'usuario' => $usuario,
            'fechaGeneracion' => $fechaGeneracion,
            'isPdf' => true
        ])->setPaper('A4', 'portrait');

        return $pdf->download('Reporte_Usuarios_por_Curso.pdf');
    }
}
