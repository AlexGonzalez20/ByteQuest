<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Notifications\ResetPasswordNotification;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => [
                'required',
                'string',
                'min:8'
                // Al menos una mayúscula y un número
            ],
        ]);

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            $usuario = Auth::user();
            if ($usuario->rol_id == 1) { // Por ejemplo, 1 = usuario 
                $usuarios = Usuario::all();
                return view('Usuarios.home', compact('usuarios'));
            } elseif ($usuario->rol_id == 2) {
                $usuarios = Usuario::all(); // 2 = administrador
                return view('dashboard', compact('usuarios'));
            } else {
                return redirect()->route('login')->with('error', 'Acceso no autorizado');
            }
        }

        return back()->withErrors([
            'email' => 'Credenciales incorrectas.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }



    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email' => [
                'required',
                'email',
                'unique:usuarios,email',
                'regex:/^[a-zA-Z0-9._%+-]+@(gmail|hotmail)\.com$/'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:15',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&#.$($)$-$_])[A-Za-z\d$@$!%*?&#.$($)$-$_]{8,15}$/',
                'confirmed'
            ],
        ],[
        'email.regex' => 'El correo debe ser de dominio gmail.com o hotmail.com.',
        'email.unique' => 'Este correo ya está registrado.',
        'password.regex' => 'La contraseña debe tener entre 8 y 15 caracteres, incluir mayúsculas, minúsculas, números y un carácter especial.',
        'password.confirmed' => 'Las contraseñas no coinciden.'
        // Otros mensajes personalizados...
    ]);


        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Usuario::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        return redirect('/login')->with('success', 'Registro exitoso. Ya puedes iniciar sesión.');
    }

    // Mostrar formulario para recuperar contraseña
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    // Enviar enlace de recuperación de contraseña
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Buscar usuario por email
        $usuario = \App\Models\Usuario::where('email', $request->email)->first();
        if (!$usuario) {
            return back()->withErrors(['email' => 'No se encontró un usuario con ese email.']);
        }

        // Generar token único
        $token = Str::random(60);
        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => now()
            ]
        );

        $usuario->notify(new ResetPasswordNotification($token));
        return back()->with('status', 'Se ha enviado un enlace de recuperación a tu email.');
    }

    // Mostrar formulario para restablecer contraseña
    public function showResetForm(Request $request, $token)
    {
        $email = $request->query('email');
        return view('auth.reset-password', ['token' => $token, 'email' => $email]);
    }

    // Procesar el restablecimiento de contraseña
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'token' => 'required'
        ]);

        // Buscar el registro de password_resets
        $reset = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$reset) {
            return back()->withErrors(['email' => 'El enlace de recuperación no es válido o ha expirado.']);
        }

        // Buscar el usuario y actualizar la contraseña
        $usuario = \App\Models\Usuario::where('email', $request->email)->first();
        if (!$usuario) {
            return back()->withErrors(['email' => 'No se encontró un usuario con ese email.']);
        }
        $usuario->password = Hash::make($request->password);
        $usuario->save();

        // Eliminar el registro de password_resets
        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', '¡Contraseña restablecida correctamente! Ya puedes iniciar sesión.');
    }

    // Actualizar perfil de usuario
    public function updateProfile(Request $request)
    {
        $user = Usuario::find(Auth::id());
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('profile', 'public');
            $user->imagen = $path;
        }

        $user->save();
        return back()->with('success', 'Perfil actualizado correctamente.');
    }
}
