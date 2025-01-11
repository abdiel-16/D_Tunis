<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\movie;
use App\Models\User;  // Ajouter pour récupérer les techniciens
use Illuminate\Http\Request;

class TechnicienController extends Controller
{



    public function index()
    {
        $schedules = Schedule::with('movie')->get();
        $movies = movie::all();
        
        return view('techdashboard', compact('schedules','movies'));
    }






    public function store(Request $request)
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

        return redirect()->route('technicien.dashboard')->with('success', 'Diffusion programmée avec succès!');
    }




    public function update(Request $request, $id)
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

        return redirect()->route('technicien.dashboard')->with('success', 'Diffusion modifiée avec succès !');
    }

    public function destroy($id)
    {
        // Supprimer la diffusion
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('technicien.dashboard')->with('success', 'Diffusion supprimée avec succès !');
    }




    public function edit($id)
{
    $schedule = Schedule::findOrFail($id);
    $movies = movie::all();
    $technicians = User::all();  // Récupérer tous les techniciens
    return view('editSchedule', compact('schedule', 'movies', 'technicians'));
}
}

