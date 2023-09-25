<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('forms.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // L'utilisateur est authentifié, redirigez-le vers la page souhaitée.
            return redirect()->intended('/');
        }

        // Si l'authentification échoue, redirigez l'utilisateur vers le formulaire de connexion avec un message d'erreur.
        return redirect()->route('login')->with('error', 'Email ou mot de passe incorrect.');
    }

    public function logout()
    {
        Auth::logout(); 
        return redirect()->route('main'); 
    }
}
