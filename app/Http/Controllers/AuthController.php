<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function loginFormulario()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
    
        $user = User::where('email', $email)->first();
    
        if ($user && password_verify($password, $user->password)) {
            $request->session()->put('user_id', $user->id);
    
            return redirect()->intended('tareas/listar');
        }
    
        return back()->withErrors(['email' => 'Credenciales incorrectas']);
    }    
    
    public function logout(Request $request)
    {
        $request->session()->forget('user_id');
        return redirect('login');
    }

    public function recuperarContrasenaFormulario()
    {
        return view('auth.password');
    }

    public function recuperarContrasena(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->password = $request->password;
            $user->save();

            return redirect()->intended('login');
        }
    }
}
