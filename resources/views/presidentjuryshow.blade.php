<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Évaluations du Film</title>
    <link rel="stylesheet" href="{{ asset('css/presidentjuryshow.css') }}">
</head>
<body>
    <div class="container">

        <h1>{{ $movie->titre }} - Évaluations</h1>

        <div class="info_movie">
            <img src="{{ asset('storage/' . $movie->affiche) }}" alt="{{ $movie->titre }}">
            <div class="info_notes">
                <h3>Notes des jurys :</h3>
                <ul>
                    @foreach ($evaluations as $evaluation)
                        <li>
                            <strong>{{ $evaluation->jury->nom }} :</strong>{{ ($evaluation->audiovisuel + $evaluation->scenario + $evaluation->appreciation)/2 }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="total_note">
            <h3>Total des notes des jurys : {{ $total/2 }}</h3>
        </div>

        <div class="form_note_finale">
            <h3>Attribuer une note finale :</h3>
            <form action="{{ route('presidentjury.finalize', $movie->id) }}" method="POST">
                @csrf
                <label for="final_note">Note finale :</label>
                <input type="number" name="final_note" min="0" max="10" step="0.1"required>
                <button type="submit">Soumettre la note finale</button>
            </form>
        </div>
    </div>
</body>
</html>
