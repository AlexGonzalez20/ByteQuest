<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\LeccionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PreguntaController;
use App\Models\Usuario;

// Redirigir la raíz al login
Route::get('/', function () {
    return view('landing');
})->name('landing');


// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Registro
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Recuperar contraseña
Route::get('/password/forgot', [AuthController::class, 'showForgotForm'])->name('password.request');
Route::post('/password/email', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.update');

// Dashboard protegido por middleware auth
Route::get('/dashboard', function () {
    $usuarios = Usuario::all();
    return view('dashboard', compact('usuarios'));
})->middleware('auth');

// Recursos protegidos por auth
Route::middleware(['auth'])->group(function () {
    Route::resource('courses', CursoController::class);
    Route::resource('lecciones', LeccionController::class);
    Route::get('/cuestionarios', [PreguntaController::class, 'index'])->name('preguntas.index');
    Route::get('/cuestionarios/crear', [PreguntaController::class, 'create'])->name('preguntas.create');
    Route::post('/cuestionarios', [PreguntaController::class, 'store'])->name('preguntas.store');
});

// Ruta para actualizar el perfil del usuario
Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');

// Grupo de rutas para el módulo de vistas
Route::prefix('views')->middleware(['auth'])->group(function () {
    Route::get('/courses', [CursoController::class, 'index'])->name('views.AdCourses');
    Route::get('/AdQuest', [PreguntaController::class, 'index'])->name('views.AdQuest');
    Route::view('/profile', 'profile')->name('views.profile');
    Route::view('/dashboard', 'dashboard')->name('views.dashboard');
    // Route::view('/EditCourses', 'courses.EditCourses')->name('views.EditCourses');
    Route::view('/dash', 'dash')->name('views.dash');
    // Puedes agregar más rutas de vistas aquí
    Route::view('/create', 'courses.create')->name('views.create');
    Route::view('/EditQuest', 'quest.EditQuest')->name('views.EditQuest');
    Route::view('/selectCourse', 'quest.selectCourse')->name('views.selectCourse');

    // Puedes agregar más rutas de vistas aquíz
});

// Ruta GET para editar cursos por ID recibido por input (courses.edit)
Route::get('/courses/edit', [CursoController::class, 'edit'])->name('courses.edit');
