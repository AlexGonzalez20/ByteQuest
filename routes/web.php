<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\LeccionController;
use App\Http\Controllers\AuthController;
use App\Models\Usuario;

// Redirigir la raíz al login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Registro
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Dashboard protegido por middleware auth
Route::get('/dashboard', function () {
    $usuarios = Usuario::all();
    return view('dashboard', compact('usuarios'));
})->middleware('auth');

// Recursos protegidos por auth
Route::middleware(['auth'])->group(function () {
    Route::resource('cursos', CursoController::class);
    Route::resource('lecciones', LeccionController::class);
});

// Grupo de rutas para el módulo de vistas
Route::prefix('views')->middleware(['auth'])->group(function () {
    Route::view('/courses', 'courses')->name('views.courses');
    // Puedes agregar más rutas de vistas aquí
});
