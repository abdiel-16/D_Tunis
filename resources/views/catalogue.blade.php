<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue des Films</title>
    <link rel="stylesheet" href="{{ asset('css/catalogue.css') }}">
</head>
<body>
    
    <header>
        <nav>
            <img src="" alt="Logo du site" class="logo">

            <ul class="nav-links">
                <li><a href="{{ url('/') }}" target="_parent">ACCUEIL</a></li>
                <li><a href="{{ url('/planning') }}" target="_parent">PLANNING</a></li>
                <li><a href="{{ url('/catalogue') }}" target="_parent">CATALOGUE</a></li>
                <li><a href="{{ url('/inscription') }}" target="_parent">INSCRIPTION</a></li>
                @if(Auth::check() && (Auth::user()->hasRole('producteur') || Auth::user()->hasRole('administrateur') || Auth::user()->hasRole('technicien')))
                    <li><a href="{{ url('/paramètre') }}" target="_parent">PARAMÈTRE</a></li>
                @endif
            </ul>
        </nav>
    </header>

    <div class="container">
        <h1>Catalogue des Films</h1>

        <!-- Formulaire de recherche -->
        <form method="GET" action="{{ route('catalogue') }}" class="search-form">
            <input type="text" name="titre" placeholder="Rechercher par titre" value="{{ request('titre') }}">
            <input type="text" name="genre" placeholder="Rechercher par genre" value="{{ request('genre') }}">
            <button type="submit">Rechercher</button>
        </form>

        <!-- Liste des films -->
        <div class="movies-list">
            @forelse ($movies as $movie)
                <div class="movie-item">
                <a href="{{ route('film.show', $movie->id) }}">
                    <img src="{{ asset('storage/' . $movie->affiche) }}" alt="{{ $movie->titre }}">
                </a>
                    <h2>{{ $movie->titre }}</h2>
                    <p><strong>Genres :</strong> 
                        @foreach ($movie->genres as $genre)
                            <span>{{ $genre->nom }}</span>
                        @endforeach
                    </p>
                </div>
            @empty
                <p>Aucun film trouvé.</p>
            @endforelse
        </div>
    </div>


    <footer>
        <div class="footer-content">
            <!-- Informations de contact -->
            <div class="contact-info">
                <p><strong>Email :</strong> rkouassi372@gmail.com</p>
                <p><strong>Numéro :</strong> +225 0170972808</p>
            </div>

            <!-- Liens vers les réseaux sociaux -->
            <div class="social-media">
                <a href="https://wa.me/+2250170972808" target="_blank" class="social-icon whatsapp" title="WhatsApp">📱</a>
                <a href="https://www.instagram.com/docatunis" target="_blank" class="social-icon instagram" title="Instagram">📸</a>
                <a href="https://twitter.com/docatunis" target="_blank" class="social-icon twitter" title="Twitter">🐦</a>
            </div>

            <!-- Slogan -->
            <p class="catchphrase">Rejoignez-nous pour vivre le festival DOC A TUNIS !</p>
        </div>
    </footer>
</body>
</html>
