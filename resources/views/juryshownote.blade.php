<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes films notés</title>
    <link rel="stylesheet" href="{{ asset('css/juryshownote.css') }}">
</head>
<body>
    <a href=""></a>
    <main>
        <h1>Films que vous avez notés</h1>
        @if($filmsNoted->isEmpty())
            <p>Vous n'avez pas encore noté de films.</p>
        @else
            <div class="les_films">
                @foreach($filmsNoted as $evaluation)
                    <div class="film">
                            <img src="{{ asset('storage/' . $evaluation->movie->affiche) }}" alt="{{ $evaluation->movie->titre }}">
                        <div>
                            <h3>{{ $evaluation->movie->titre }}</h3>
                            <p>Qualité audiovisuelle : {{ $evaluation->audiovisuel }}/10</p>
                            <p>Scénario : {{ $evaluation->scenario }}/7</p>
                            <p>Appréciation personnelle : {{ $evaluation->appreciation }}/3</p>
                            
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>


</body>
</html>
