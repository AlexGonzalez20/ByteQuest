
    <?php

    use Illuminate\Support\Facades\Route;

    use App\Http\Controllers\CursoController;
    use App\Http\Controllers\UsuarioController;
    use App\Http\Controllers\LeccionController;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\PreguntaController;
    use App\Http\Controllers\ReporteUsuariosController;
    use App\Http\Controllers\ImagenesController;
    use App\Http\Controllers\PruebaController;
    use App\Http\Controllers\ProgresoController;
    use App\Http\Controllers\TiendaController;
    use App\Http\Controllers\AprenderController;
    use App\Http\Controllers\RecuperarVidasController;
    use App\Http\Controllers\PaymentController;


    use App\Models\Usuario;
    use App\Http\Controllers\TablaController;
    // 🌟 Landing
    Route::get('/', fn() => view('landing'))->name('landing');

    // ✅ Autenticación
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/password/forgot', [AuthController::class, 'showForgotForm'])->name('password.request');
    Route::post('/password/email', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.update');

    // ✅ Dashboard protegido
    Route::get('/dashboard', [TablaController::class, 'grafica'])
        ->middleware('auth')
        ->name('views.dashboard');

    // ✅ Recursos
    Route::middleware(['auth'])->group(function () {
        Route::resource('usuarios', UsuarioController::class);
        Route::resource('cursos', CursoController::class);
        Route::resource('preguntas', PreguntaController::class);
        Route::resource('pruebas', PruebaController::class);
        Route::resource('lecciones', LeccionController::class)->parameters([
            'lecciones' => 'leccion'
        ]);
    });

    // ✅ Perfil
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');

    // ✅ Módulo vistas
    Route::prefix('views')->middleware(['auth'])->group(function () {
        Route::get('/AdQuest', [PreguntaController::class, 'index'])->name('views.AdQuest');
        Route::view('/EditarUsuario', 'CrudUsuarios.EditarUsuario')->name('views.EditarUsuario');
        Route::view('/CrearUsuario', 'CrudUsuarios.CrearUsuario')->name('views.CrearUsuario');
        Route::get('/cursos', [UsuarioController::class, 'catalogoCursos'])->name('views.UCursos');
        Route::get('/miscursos', [UsuarioController::class, 'misCursos'])->name('views.UMisCursos');
        Route::view('/perfil', 'VistasEstudiante.perfil')->name('views.UPerfil');
    });

    // ✅ Reportes
    Route::get('reportes/usuariosPorCurso', [ReporteUsuariosController::class, 'index'])
        ->name('reportes.usuarios.index');
    Route::get('reportes/usuariosPorCurso/pdf', [ReporteUsuariosController::class, 'descargarPdf'])
        ->name('reportes.usuarios.pdf');

    // ✅ Imagenes
    Route::post('/imagen/upload', [ImagenesController::class, 'upload'])->name('imagen.upload');

    // ✅ Cursos: seguir y dejar
    Route::post('/usuarios/seguir-curso/{curso_id}', [UsuarioController::class, 'seguirCurso'])
        ->name('usuarios.seguirCurso')->middleware('auth');
    Route::post('/usuarios/dejar-curso/{curso_id}', [UsuarioController::class, 'dejarCurso'])
        ->name('usuarios.dejarCurso')->middleware('auth');

    // ✅ Camino de aprendizaje
    Route::get('/camino/{curso_id}', [App\Http\Controllers\CaminoController::class, 'mostrar'])
        ->name('usuarios.caminoCurso')->middleware('auth');

    // ✅ Reclamar XP
    // Route::post('/lecciones/{leccion_id}/reclamar-xp', [LeccionController::class, 'reclamarXP'])
    //     ->name('lecciones.reclamarXP')->middleware('auth');

    // ✅ Preguntas y progreso

    Route::post('/pregunta/responder', [ProgresoController::class, 'responderPregunta'])
        ->name('pregunta.responder')->middleware('auth');

    Route::get('/home', [UsuarioController::class, 'home'])
        ->name('views.UsuarioHome')
        ->middleware('auth');


    Route::get('/pregunta/mostrar/{prueba_id}', [ProgresoController::class, 'mostrarPregunta'])
        ->name('pregunta.mostrar')
        ->middleware('auth');

    Route::get('/tienda', [TiendaController::class, 'index'])
        ->name('tienda')
        ->middleware('auth');

    Route::get('/pago', [TiendaController::class, 'pago'])
        ->middleware('auth')
        ->name('pago');


    Route::get('/aprender', [AprenderController::class, 'index'])
        ->name('aprender')
        ->middleware('auth');

    Route::get('/recuperarVidas', [RecuperarVidasController::class, 'index'])
        ->name('recuperarVidas')
        ->middleware('auth');

    Route::get('/pregunta/siguiente/{curso_id}', [PreguntaController::class, 'siguiente'])
        ->name('siguiente.pregunta');


    Route::post('/pago/checkout', [PaymentController::class, 'checkout'])->name('pago.checkout');
    Route::get('/success', [PaymentController::class, 'success'])->name('pago.success');
    Route::get('/failure', [PaymentController::class, 'failure'])->name('pago.failure');
    Route::get('/pending', [PaymentController::class, 'pending'])->name('pago.pending');

    Route::get('/test-mercadopago', [PaymentController::class, 'test']);
