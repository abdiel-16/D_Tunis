<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $movie->titre }}</title>
    <link rel="stylesheet" href="{{ asset('css/filmshow.css') }}">
</head>
<body>
    <div class="container">
        <h1>{{ $movie->titre }}</h1>
        <div class="infos">
            <div class="affiche">
                <img src="{{ asset('storage/' . $movie->affiche) }}" alt="{{ $movie->titre }}">
            </div>
            <div class="info1">
                <p><strong>Genres :</strong>
                    @foreach ($movie->genres as $genre)
                        <span>{{ $genre->nom }}</span>
                    @endforeach
                </p>
                <p><strong>Durée :</strong> {{ $movie->duree }} minutes</p>
                <p><strong>Date de sortie :</strong> {{ $movie->date_sortie }}</p>
            </div>
        </div>
        <div class="synopsis">
            <p><strong>Synopsis :</strong> {{ $movie->synopsis }}</p>
        </div>
        <div class="tableau_planning">
            <h2>Planning</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date de diffusion</th>
                        <th>Heure de diffusion</th>
                        <th>Salle</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedules as $schedule)
                        <tr>
                            <td>{{ $schedule->date }}</td>
                            <td>{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                            <td>{{ $schedule->salle }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
