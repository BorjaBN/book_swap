<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Mostrar el formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesar el login
    public function login(Request $request)
    {
        // Validar los datos
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'tipo_usuario' => 'required|in:usuario,entidad',
        ]);

        // ¿Es usuario común o entidad cultural?
        if ($request->tipo_usuario === 'usuario') {
            $guard = 'web';
            $credentials = ['email_usuario_comun' => $request->email];
            
        } else {
            $guard = 'entidad';
            $credentials = ['email_entidad_cultural' => $request->email];
            
        }

        // Intentar autenticar
        if (Auth::guard($guard)->attempt($credentials + ['password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        // Si falla, volver con error
        return back()->withErrors([
            'email' => 'Las credenciales no son correctas.',
        ])->onlyInput('email');
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        Auth::guard('entidad')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}