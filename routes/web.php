<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LeccionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PreguntaController;
use App\Http\Controllers\ReporteUsuariosController;
use App\Http\Controllers\ImagenesController;
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
    Route::resource('courses', CourseController::class);
    Route::resource('lecciones', LeccionController::class);
});

Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');


// Ruta para actualizar el perfil del usuario
Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');

// Grupo de rutas para el módulo de vistas
Route::prefix('views')->middleware(['auth'])->group(function () {
    Route::get('/courses', [CourseController::class, 'index'])->name('views.AdCourses');
    Route::get('/AdQuest', [PreguntaController::class, 'index'])->name('views.AdQuest');
    Route::view('/profile', 'profile')->name('views.profile');
    Route::view('/dashboard', 'dashboard')->name('views.dashboard');
    Route::view('/EditCourses', 'courses.EditCourses')->name('views.EditCourses');
    // Route::view('/GestionarUsuario', 'CrudUsuarios.GestionarUsuario')->name('views.GestionarUsuario');
    Route::view('/EditarUsuario', 'CrudUsuarios.EditarUsuario')->name('views.EditarUsuario');
    Route::view('/CrearUsuario', 'CrudUsuarios.CrearUsuario')->name('views.CrearUsuario');
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('cursos', CursoController::class);
    Route::resource('preguntas', PreguntaController::class);




    Route::view('/dash', 'dash')->name('views.dash');
    // Puedes agregar más rutas de vistas aquí
    Route::view('/create', 'courses.create')->name('views.create');
    Route::view('/EditQuest', 'quest.EditQuest')->name('views.EditQuest');
    // Route::view('/EditCourses', 'courses.EditCourses')->name('views.EditCourses');
    Route::view('/selectCourse', 'quest.selectCourse')->name('views.selectCourse');

    // Puedes agregar más rutas de vistas aquíz
});

Route::get('reportes/usuarios-por-curso', [ReporteUsuariosController::class, 'index'])
    ->name('reportes.usuarios.index');

Route::get('reportes/usuarios-por-curso/pdf', [ReporteUsuariosController::class, 'descargarPdf'])
    ->name('reportes.usuarios.pdf');

Route::post('/imagen/upload', [ImagenesController::class, 'upload'])->name('imagen.upload');



// Eliminar referencias a CursoController y rutas personalizadas antiguas si existen
