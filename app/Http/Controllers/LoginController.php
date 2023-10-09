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
            $user = Auth::user();

            // Vérifiez si l'utilisateur a complété son profil
            if (!$user->profil_completed) {
                // Redirigez l'utilisateur vers la page de profil pour compléter son profil
                session(['user_id' => $user->id]);
                return redirect()->route('InfosProfil')->with('message_complete_profil', 'Bienvenue! Veuillez compléter votre profil afin de finaliser votre inscription.');
            }

            // Si le profil est complété ou non requis, redirigez l'utilisateur vers la page souhaitée.
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
