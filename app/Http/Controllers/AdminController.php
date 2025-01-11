<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Genre;
use App\Models\movie;
use App\Models\Schedule;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Afficher tous les utilisateurs
    public function index()
    {
        $users = User::all(); // Récupérer tous les utilisateurs
        $genres = Genre::all();
        $movies = Movie::all();
        $schedules = Schedule::all();
        return view('parametre', compact('users','genres','movies','schedules'));
    }






   
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:producteur,jury,inspecteur,visiteur,administrateur',
        ]);

        // Création de l'utilisateur
        $user = new User();
        $user->nom = $validated['nom'];
        $user->email = $validated['email'];
        $user->password = bcrypt($validated['password']);
        $user->role = $validated['role'];  // Assigner le rôle
        $user->save();

        return redirect()->route('admin.parametre')->with('success', 'Utilisateur ajouté avec succès');
    }

    // Modifier un utilisateur (mettre à jour son rôle)
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'role' => 'required|string|in:producteur,jury,inspecteur,visiteur,administrateur',
        ]);

        $user = User::findOrFail($id);
        $user->role = $validated['role']; // Modifier le rôle
        $user->save();

        return redirect()->route('admin.parametre')->with('success', 'Rôle de l\'utilisateur mis à jour');
    }

    
    

     // Supprimer un utilisateur
     public function destroy($id)
     {
         $user = User::findOrFail($id);
         $user->delete();
 
         return redirect()->route('admin.parametre')->with('success', 'Utilisateur supprimé avec succès');
     }
 }


