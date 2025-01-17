<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Evaluation;
use App\Models\Movie;

class JuryController extends Controller
{
    public function store(Request $request)
    {

        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'audiovisuel' => 'required|integer|between:0,10',
            'scenario' => 'required|integer|between:0,7',
            'appreciation' => 'required|integer|between:0,3',
        ]);


        $Evaluation = new Evaluation();
        $Evaluation->movie_id = $validated['movie_id'];
        $Evaluation->jury_id = auth()->id();
        $Evaluation->audiovisuel = $validated['audiovisuel'];  
        $Evaluation->scenario = $validated['scenario'];
        $Evaluation->appreciation = $validated['appreciation'];
        $Evaluation->save();

        return redirect()->route('catalogue')->with('success', 'Évaluation enregistrée avec succès !');
    }

    public function index()
    {
        $filmsNoted = Evaluation::where('jury_id', auth()->id())
                                ->with('movie')
                                ->get();

        return view('juryshownote', compact('filmsNoted'));
    }




    public function show($movieId)
    {
        
        $movie = Movie::findOrFail($movieId);
        
        $evaluations = Evaluation::where('movie_id', $movieId)
                                  ->with('jury') 
                                  ->get();

        //total des notes de tous les jurys
        $total = $evaluations->sum(function ($evaluation){
            return $evaluation->audiovisuel + $evaluation->scenario + $evaluation->appreciation;
        });

        return view('presidentjuryshow', compact('movie', 'evaluations', 'total'));
    }

    public function finalize(Request $request, $movieId)
    {
        $request->validate([
            'final_note' => 'required|numeric|between:0,10',
        ]);

        $movie = Movie::findOrFail($movieId);
        $movie->note_finale = $request->final_note;
        $movie->save();

        return redirect()->route('catalogue', $movieId)->with('success', 'Note finale enregistrée avec succès.');
    }

}
