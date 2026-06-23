<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // mostra a tela de login
    public function index()
    {
        return view('auth.login');
    }

    // tenta fazer o login com o email e senha que vieram do formulario
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credenciais = $request->only('email', 'password');

        // o Auth::attempt ja confere o email e a senha (com o hash) pra gente
        if (Auth::attempt($credenciais)) {
            // regenera a sessao por segurança
            $request->session()->regenerate();

            return redirect()->route('agentes.index');
        }

        // se nao deu certo, volta pro login com uma mensagem de erro
        return back()->withErrors([
            'email' => 'E-mail ou senha incorretos.',
        ])->onlyInput('email');
    }

    // desloga o usuario
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
