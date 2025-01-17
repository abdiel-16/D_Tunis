<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Mon Application de Films</title>

    <link rel="stylesheet" href="{{ asset('css/inscription.css') }}">
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
    <div class="container mt-5">
        <h2>Formulaire d'inscription</h2>

        <!-- Formulaire d'inscription -->
        <form method="POST" action="{{ url('/inscription') }}">
            @csrf

            <div class="mb-3">
                <label for="nom" class="form-label">Nom complet</label>
                <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
                @error('nom') 
                    <div class="text-danger">{{ $message }}</div> 
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                @error('email') 
                    <div class="text-danger">{{ $message }}</div> 
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
                @error('password') 
                    <div class="text-danger">{{ $message }}</div> 
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn">S'inscrire</button>
        </form>

        <div class="footer">
            <p>Déjà un compte ? <a href="{{ url('/connexion') }}">Se connecter</a></p>
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
    

    <!-- Lien vers le script Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
