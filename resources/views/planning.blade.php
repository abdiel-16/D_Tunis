<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planning des Films</title>
    <link rel="stylesheet" href="/css/planning.css">
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
        <h1>Planning des Films</h1>

        <!-- Section pour les films du jour -->
        <div class="section-today">
            <h2>Films du {{ date('d/m/Y') }}</h2>
            <div class="films-scrollable">
            @forelse ($filmsToday as $movie)
                @forelse ($movie->schedules as $schedule)
                    <div class="film">
                        <a href="{{ route('film.show', $movie->id) }}">
                            <img src="{{ asset('storage/' . $movie->affiche) }}" alt="{{ $movie->titre }}">
                        </a>
                        <h3>{{ $movie->titre }}</h3>
                        <p><strong>Heure :</strong> {{ $schedule->start_time }} - {{ $schedule->end_time }}</p>
                        <p><strong>Salle :</strong> {{ $schedule->salle }}</p>
                    </div>
                @empty
                    <p>Aucun horaire disponible pour ce film.</p>
                @endforelse
            @empty
                <p>Aucun film prévu aujourd'hui.</p>
            @endforelse

            </div>
        </div>

        <!-- Section pour les films à venir -->
        <div class="section-upcoming">
            <h2>Prochaines séances</h2>
            <div class="films-scrollable">
                @forelse ($filmsUpcoming as $movie)
                    
                        <div class="film">
                            <a href="{{ route('film.show', $movie->id) }}">
                                <img src="{{ asset('storage/' . $movie->affiche) }}" alt="{{ $movie->titre }}">
                            </a>
                                <h3>{{ $movie->titre }}</h3>
                                <p><strong>Date :</strong> {{ $movie->date }}</p>
                                <p><strong>Heure :</strong> {{ $movie->start_time }} - {{ $movie->end_time }}</p>
                                <p><strong>Salle :</strong> {{ $movie->salle }}</p>
                        </div>
                    
                @empty
                    <p>Aucune séance à venir pour le moment.</p>
                @endforelse
            </div>
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
