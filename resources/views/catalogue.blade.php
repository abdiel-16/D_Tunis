<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue des Films</title>
    <link rel="stylesheet" href="{{ asset('css/catalogue.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/head.css') }}">
</head>
<body>
    
    <header>
        <nav>
            <img src="{{ asset('/images/docàtunis.svg') }}" alt="Logo du site" class="logo">

            <ul class="nav-links">
                <li><a href="{{ url('/') }}" target="_parent"><i class="fas fa-home"></i>  ACCUEIL</a></li>
                <li><a href="{{ url('/planning') }}" target="_parent"><i class="fas fa-calendar-alt"></i>  PLANNING</a></li>
                <li><a href="{{ url('/catalogue') }}" target="_parent"><i class="fas fa-book"></i>  CATALOGUE</a></li>
                @if(Auth::check())
                    <li>
                        <details>
                            <summary>
                                <i class="fas fa-user-check fa-1x"></i> {{ Auth::user()->nom }} (Connecté)
                            </summary>
                            <ul class="logout-menu">
                                <form action="{{ route('deconnexion') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="logout-btn">
                                        <i class="fas fa-sign-out-alt"></i> Se déconnecter
                                    </button>
                                </form>
                            </ul>
                        </details>
                    </li>
                @else
                    <li><a href="{{ url('/inscription') }}" target="_parent"><i class="fas fa-user-plus"></i>   INSCRIPTION</a></li>
                @endif               
                @if(Auth::check() && (Auth::user()->hasRole('producteur') || Auth::user()->hasRole('administrateur') || Auth::user()->hasRole('technicien')))
                    <li><a href="{{ url('/paramètre') }}" target="_parent"><i class="fas fa-cog"></i> PARAMÈTRE</a></li>
                @endif
            </ul>
        </nav>
    </header>

    <div class="container">
        <h1>Catalogue des Films</h1>

        <!-- Formulaire de recherche -->
        <div class="haut_page">
            <form method="GET" action="{{ route('catalogue') }}" class="search-form">
                <input type="text" name="titre" placeholder="Rechercher par titre" value="{{ request('titre') }}">
                <input type="text" name="genre" placeholder="Rechercher par genre" value="{{ request('genre') }}">
                <button type="submit">Rechercher</button>
                </form>
            @if(Auth::check() && (Auth::user()->hasRole('jury')))
                <a href="{{route('evaluations.jury')}}"><button >Voir mes films notés</button></a>
            @endif
        </div>
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
                    @if(!is_null($movie->note_finale))
                    <p><strong>Notes :</strong>{{ $movie->note_finale }}</p>
                    @endif
                    @if(is_null($movie->note_finale))
                        @if(Auth::check() && (Auth::user()->hasRole('jury')))
                            @php
                                $alreadyVoted = \App\Models\Evaluation::where('jury_id', auth()->id())
                                                                    ->where('movie_id', $movie->id)
                                                                    ->exists();
                            @endphp
                            @if(!$alreadyVoted)
                                <button onclick="openModal({{ $movie->id }})">Noter</button>
                            @else
                                <p>Vous avez déjà voté pour ce film.</p>
                            @endif
                        @endif
                        @if(Auth::check() && Auth::user()->hasRole('presidentjury'))
                            <form action="{{ route('presidentjury.show', $movie->id) }}" method="GET">
                                <button type="submit">Confirmer note</button>
                            </form>
                        @endif
                    @endif
                </div>


                <div id="modal-{{ $movie->id }}" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal({{ $movie->id }})">&times;</span>
                        <h3>Évaluer le film : {{ $movie->titre }}</h3>
                        <form action="{{ route('evaluations.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                            <label for="audiovisuel">Qualité audiovisuelle (sur 10) :</label>
                            <input type="number" name="audiovisuel" max="10" min="0" required>
                            <br>

                            <label for="scenario">Scénario (sur 7) :</label>
                            <input type="number" name="scenario" max="7" min="0" required>
                            <br>

                            <label for="appreciation">Appréciation personnelle (sur 3) :</label>
                            <input type="number" name="appreciation" max="3" min="0" required>
                            <br>

                            <button type="submit">Envoyer ma note</button>
                        </form>
                    </div>
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

    <script src="{{ asset('js/modal.js') }}"></script>
</body>
</html>
