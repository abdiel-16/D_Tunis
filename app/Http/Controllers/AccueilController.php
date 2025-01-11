<?php

namespace App\Http\Controllers;
use App\Models\movie;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AccueilController extends Controller
{


    public function index()
    {
        $movies = movie::all();
        return view('accueil',compact('movies')); // Affiche la page d’accueil
    }





    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        $schedules = $movie->schedules;
        return view('filmShow', compact('movie','schedules'));
    }





    public function catalogue(Request $request)
    {
        $query = Movie::query();

        // Filtrer par titre si une recherche est effectuée
        if ($request->has('titre') && $request->titre != '') {
            $query->where('titre', 'like', '%' . $request->titre . '%');
        }

        // Filtrer par genre si une recherche est effectuée
        if ($request->has('genre') && $request->genre != '') {
            $query->whereHas('genres', function ($q) use ($request) {
                $q->where('nom', 'like', '%' . $request->genre . '%');
            });
        }

        // Récupérer les films triés par titre
        $movies = $query->orderBy('titre')->get();

        return view('catalogue', compact('movies'));
    }




    public function showPlanning()
    {
        $today = Carbon::now()->format('Y-m-d');
    
        // Films qui passent aujourd'hui
        $filmsToday = Movie::whereHas('schedules', function ($query) use ($today) {
            $query->whereDate('date', $today);
        })->with('schedules')->get();
    
        // Films pour les jours futurs
        $filmsUpcoming = Movie::join('schedules', 'movies.id', '=', 'schedules.movie_id')
            ->whereDate('schedules.date', '>', $today)
            ->orderBy('schedules.date', 'asc')
            ->select('movies.*', 'schedules.date', 'schedules.start_time', 'schedules.end_time', 'schedules.salle')
            ->get();
            
    
        return view('planning', compact('filmsToday', 'filmsUpcoming'));
    }





    public function listeFilms()
    {
        return view('films'); // Affiche la liste des films
    }

    public function contact()
    {
        return view('contact'); // Affiche la page de contact
    }

}
