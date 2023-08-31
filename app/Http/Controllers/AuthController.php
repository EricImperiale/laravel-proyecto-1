<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function formLogin()
    {
        return view('auth.form-login');
    }

    public function processLogin(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if(!auth()->attempt($credentials)) {
            return redirect()
                ->back()
                ->with('status.message', 'Las credenciales ingresadas no coinciden con nuestros registros.')
                ->withInput();
        }

        $request->session()->regenerate();

        return redirect()
            ->route('movies.index')
            ->with('status.message', 'Iniciaste sesión con éxito. ¡Hola de nuevo!');
    }

    public function processLogout(Request $request)
    {
        auth()->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('auth.formLogin')
            ->with('status.message', 'Cerrarse tu sesión con éxito. ¡Volvé pronto!');
    }
}
