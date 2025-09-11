<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Curso;
use App\Models\Leccion;
use Illuminate\Support\Facades\DB;

class TablaController extends Controller
{
    public function index()
    {
        // Esta función puede ser utilizada para redirigir a la vista principal del dashboard
        return redirect()->route('CDashboard.grafica');
    }

    public function tabla()
    {
        $usuariosPorDia = Usuario::select(DB::raw('DATE(created_at) as fecha'), DB::raw('count(*) as total'))
            ->groupBy('fecha')
            ->orderBy('fecha', 'desc')
            ->limit(7) // últimos 7 días
            ->get();

        // Prepara los datos para Chart.js
        $labels = $usuariosPorDia->pluck('fecha')->reverse()->values();
        $data = $usuariosPorDia->pluck('total')->reverse()->values();

        return view('contenidoDashboard.contenido', compact('labels', 'data'));
    }

    public function grafica()
    {
        $usuarios = Usuario::all();
        // 1. Usuarios nuevos por mes (últimos 6 meses)
        $usuariosPorMes = Usuario::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as mes'), DB::raw('count(*) as total'))
            ->groupBy('mes')
            ->orderBy('mes', 'desc')
            ->limit(6)
            ->get();
        $labelsUsuariosMes = $usuariosPorMes->pluck('mes')->reverse()->values();
        $dataUsuariosMes = $usuariosPorMes->pluck('total')->reverse()->values();

        // 2. Estudiantes por curso
        $cursos = Curso::withCount('usuarios')->get();
        $labelsCursos = $cursos->pluck('nombre');
        $dataCursos = $cursos->pluck('usuarios_count');

        // 3. Lecciones más vistas
        $lecciones = Leccion::select('lecciones.id', 'lecciones.nombre')
            ->leftJoin('preguntas', 'preguntas.leccion_id', '=', 'lecciones.id')
            ->leftJoin('progreso_preguntas', 'progreso_preguntas.pregunta_id', '=', 'preguntas.id')
            ->selectRaw('lecciones.nombre, COUNT(DISTINCT progreso_preguntas.usuario_id) as usuarios_count')
            ->groupBy('lecciones.id', 'lecciones.nombre')
            ->orderByDesc('usuarios_count')
            ->limit(6)
            ->get();
        $labelsLecciones = $lecciones->pluck('nombre');
        $dataLecciones = $lecciones->pluck('usuarios_count');

        return view('dashboard', compact(
            'usuarios',
            'labelsUsuariosMes',
            'dataUsuariosMes',
            'labelsCursos',
            'dataCursos',
            'labelsLecciones',
            'dataLecciones'
        ));
    }
}
