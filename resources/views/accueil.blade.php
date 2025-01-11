<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/accueil.css') }}">
    <title>Mon Application de Films - Accueil</title>
</head>

<body>
    <header>
        <nav>
            <!-- Logo du site -->
            <img src="" alt="Logo du site" class="logo">

            <!-- Formulaire de recherche -->
            

            <!-- Menu de navigation -->
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

    <main>
        <!-- Section Fond -->
        <div class="fond">
            
            <div class="texte-sur-fond">
                <h1>DOC A TUNIS</h1>
                <p>Venez suivre les actualités du festival</p>
            </div>
        </div>

        <!-- Description du site -->
        <div class="description">
            <p>DocATunis est un site mis à votre disposition pour suivre en temps réel le déroulement de votre festival préféré.</p>
        </div>

        <!-- Films Populaires -->
        <h2>Films Populaires</h2>
        <div class="categorie">
        
            <div class="populaire">
                <div class="liste_documentaire">
                <div class="films-scrollable">
                    @foreach ($movies as $movie)
                        <a href="{{ route('film.show', $movie->id) }}">
                            <div class="documentaire">
                                <img src="{{ asset('storage/' . $movie->affiche) }}" alt="{{ $movie->titre }}">
                                <h4>{{ $movie->titre }}</h4>
                                <p><em>Viens regarder en même temps</em></p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>     
            </div>

        </div>

        <!-- Bouton Voir tous les films -->
        <div class="boutton">
            <button onclick="window.location.href='{{ url('/catalogue') }}'">Voir tous les films</button>
        </div>

        <!-- Formulaire d'inscription -->
        <div class="Inscription">
            <p>Inscrivez-vous et profitez d'une meilleure expérience</p>
            <a href="{{ url('/inscription') }}">
                <button>Inscrivez-vous</button>
            </a>
        </div>
    </main>

    
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
