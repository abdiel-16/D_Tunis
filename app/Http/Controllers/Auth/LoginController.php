<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class LoginController extends Controller
{
    // Afficher le formulaire de connexion
    public function showLoginForm()
    {
        return view('login');
    }

    // Traiter le formulaire de connexion
    public function login(Request $request)
    {
        // Validation des données de connexion
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Authentification de l'utilisateur
        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], $request->filled('remember'))) {
            // Redirection vers la page du producteur ou une autre page en fonction du rôle
            return redirect()->route('producteur.dashboard');
        }

        // Retourner à la page de connexion avec une erreur si l'authentification échoue
        return back()->withErrors([
            'email' => 'Les informations de connexion sont incorrectes.',
        ]);
    }
}
