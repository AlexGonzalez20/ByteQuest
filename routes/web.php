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
//administrar cursos
// Route::get('/AdminCourses', [AuthController::class, 'links'])->name('AdminCourses');
route::get('/administrar', function(){
    return view("cursos/Admincourses");
    // return "holamundo";
});
// route::view('/admin','Admincourses.blade.php')->name(admin);
