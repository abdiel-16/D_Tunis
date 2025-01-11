<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class InscriptionController extends Controller {

    // Afficher le formulaire d'inscription
    public function showForm(){
        return view('inscription');
    }

    public function handleForm(Request $request){
        // Validation des données
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:producteur,jury,inspecteur,visiteur,administrateur', // On conserve la validation des rôles
        ]);

        // Création de l'utilisateur
        $user = new User();
        $user->nom = $validated['nom'];
        $user->email = $validated['email'];
        $user->password = bcrypt($validated['password']);

        // Assigner un rôle à l'utilisateur
        $user->role = $validated['role'];  // On assigne le rôle choisi à l'utilisateur
        $user->save();  // Sauvegarde l'utilisateur après l'assignation du rôle
        
        // Connexion automatique après l'inscription
        auth()->login($user);

        return redirect()->route('accueil')->with('success', 'Inscription réussie !');
    }
}
