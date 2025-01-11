<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Schedule;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Http\Request;

class ParametreController extends Controller
{
   
    public function index()
    {
        $user = auth()->user();
        $isProducteur = $user->role === 'producteur';
        $isTechnicien = $user->role === 'technicien';
        $isAdministrateur = $user->role === 'administrateur';
        // Récupérer les films, genres et les horaires programmés
        $users = User::all();
        $movies = Movie::all();
        $genres = Genre::all();
        $schedules = Schedule::with('movie')->get();

        // Passer les données à la vue
        return view('parametre', compact( 'isProducteur', 'isTechnicien', 'isAdministrateur','movies', 'genres', 'schedules','users'));
    }



    // Sauvegarde du film
    public function store1(Request $request)
    {
      
        // Validation des données
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'duree' => 'required|integer',
            'date_sortie' => 'required|date',
            'affiche' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id'
        ]);

        // Création du film
        $film = new movie();
        $film->titre = $validated['titre'];
        $film->synopsis = $validated['synopsis'];
        $film->duree = $validated['duree'];
        $film->date_sortie = $validated['date_sortie'];
        $film->producer_id = auth()->id();  // Assigner l'id du producteur

        // Gérer l'affiche (si une image est téléchargée)
        if ($request->hasFile('affiche')) {
            $film->affiche = $request->file('affiche')->store('affiches', 'public');
        }

        $film->save();

        // Associer les genres au film
        $film->genres()->sync($validated['genres']);

        return redirect()->route('parametres');
    }






    public function edit1($id)
    {
        // Récupérer le film par son ID
        $movie = Movie::findOrFail($id);

        $users = User::all(); // Récupérer tous les utilisateurs
        $genres = Genre::all();
        $schedules = Schedule::all();
        return view('edit', compact('users','genres','movie','schedules'));
    }






    public function update1(Request $request, $id)
    {
        // Validation des données
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'synopsis' => 'nullable|string',
            'duree' => 'nullable|integer',
            'date_sortie' => 'nullable|date',
            // Ajoute d'autres règles de validation selon tes besoins
        ]);

        // Récupérer le film par son ID
        $movie = Movie::findOrFail($id);

        // Mettre à jour les champs du film
        $movie->titre = $validated['titre'];
        $movie->synopsis = $validated['synopsis'];
        $movie->duree = $validated['duree'];
        $movie->date_sortie = $validated['date_sortie'];
        // Ajoute d'autres champs si nécessaire

        // Sauvegarder les modifications dans la base de données
        $movie->save();

        // Rediriger l'utilisateur avec un message de succès
        return redirect()->route('parametres')->with('success', 'Film modifié avec succès');
    }


  

    public function destroy1($id)
    {
        // Récupérer le film par son ID
        $movie = Movie::findOrFail($id);

        // Supprimer le film de la base de données
        $movie->delete();

        // Rediriger l'utilisateur avec un message de succès
        return redirect()->route('parametres')->with('success', 'Film supprimé avec succès');
    }







    public function store2(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'salle' => 'required|string|max:255',  
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
        ]);

        // Créer une nouvelle diffusion
        $schedule = new Schedule();
        $schedule->movie_id = $validated['movie_id'];
        $schedule->salle = $validated['salle'];  
        $schedule->date = $validated['date'];
        $schedule->start_time = $validated['start_time'];
        $schedule->end_time = $validated['end_time'];
        $schedule->save();

        return redirect()->route('parametres')->with('success', 'Diffusion programmée avec succès!');
    }




    public function update2(Request $request, $id)
    {
        // Validation des données
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'technician_id' => 'required|exists:users,id',
            'salle' => 'required|string|max:255',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
        ]);

        // Trouver la diffusion et mettre à jour ses données
        $schedule = Schedule::findOrFail($id);
        $schedule->update($validated);

        return redirect()->route('parametres')->with('success', 'Diffusion modifiée avec succès !');
    }

    public function destroy2($id)
    {
        // Supprimer la diffusion
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('parametres')->with('success', 'Diffusion supprimée avec succès !');
    }




    public function edit2($id)
{
    $schedule = Schedule::findOrFail($id);
    $users = User::all(); // Récupérer tous les utilisateurs
    $genres = Genre::all();
    $movies = Movie::all();
    return view('parametre', compact('users','genres','movies','schedules'));
}
}

