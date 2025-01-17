<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('css/parametre.css') }}" rel="stylesheet">
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

    <div class="container34">
        <h1>Paramètres</h1>
        
        <div>
            <h2>Informations du compte</h2>
            <p><strong>Bienvenue </strong>{{ Auth::user()->nom }}</p>
            <p><strong>Vous êtes connectés en tant que  </strong>{{ Auth::user()->role }}</p>
            
        </div>

        @if(Auth::user()->hasRole('producteur') || Auth::user()->hasRole('administrateur'))
            <div>
                <h2>Gestion des films et des genres</h2>
                <div class="container2">
                    <!-- Formulaire d'ajout de film -->
                    <section class="form-section">
                        <h2>Ajouter un film</h2>
                        <form action="{{ route('producteur.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label for="titre">Titre :</label>
                                <input type="text" name="titre" id="titre" required>
                            </div>
                            <div>
                                <label for="synopsis">Synopsis :</label>
                                <textarea name="synopsis" id="synopsis" required></textarea>
                            </div>
                            <div>
                                <label for="duree">Durée (minutes) :</label>
                                <input type="number" name="duree" id="duree" required>
                            </div>
                            <div>
                                <label for="date_sortie">Date de sortie :</label>
                                <input type="date" name="date_sortie" id="date_sortie" required>
                            </div>
                            <div>
                                <label for="genres">Genres :</label>
                                <select name="genres[]" id="genres" multiple required>
                                    @foreach ($genres as $genre)
                                        <option value="{{ $genre->id }}">{{ $genre->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="affiche">Affiche du film :</label>
                                <input type="file" name="affiche" id="affiche" accept="image/*" required>
                            </div>
                            <button type="submit" class="btn btn-success">Ajouter</button>
                        </form>
                    </section>
                </div>
                <div class="container3">
                <!-- Gestion des films -->
                <section>
                    <h2>Gérer mes films</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($movies as $movie)
                                <tr>
                                    <td>{{ $movie->titre }}</td>
                                    <td>
                                        <button class="btn btn-primary" onclick="window.location.href='{{ route('movies.edit', $movie->id) }}'">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </button>
                                        <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
        @endif

        @if(Auth::user()->hasRole('technicien') || Auth::user()->hasRole('administrateur'))
            <div>
                <h2>Gestion des salles et horaires</h2>
                <p>Formulaires ou options liées à la gestion des salles et des horaires.</p>
                <div class="container mt-5">
                    <h1>Programmer une diffusion</h1>
                    <form action="{{ route('technicien.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="movie_id" class="form-label">Film</label>
                            <select name="movie_id" id="movie_id" class="form-control" required>
                                @foreach ($movies as $movie)
                                    <option value="{{ $movie->id }}">{{ $movie->titre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="salle" class="form-label">Salle</label>
                            <input type="text" name="salle" id="salle" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label">Date de la diffusion</label>
                            <input type="date" name="date" id="date" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="start_time" class="form-label">Heure de début</label>
                            <input type="time" name="start_time" id="start_time" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="end_time" class="form-label">Heure de fin</label>
                            <input type="time" name="end_time" id="end_time" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Programmer la diffusion</button>
                    </form>
                </div>
                <div class="container">
                    <h2>Diffusions programmées</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Film</th>
                                <th>Salle</th>
                                <th>Date</th>
                                <th>Heure de début</th>
                                <th>Heure de fin</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $schedule)
                                <tr>
                                    <td>{{ $schedule->movie->titre }}</td>
                                    <td>{{ $schedule->salle }}</td>
                                    <td>{{ $schedule->date }}</td>
                                    <td>{{ $schedule->start_time }}</td>
                                    <td>{{ $schedule->end_time }}</td>
                                    <td>
                                        <button class="btn btn-primary" onclick="window.location.href='{{ route('movies.edit', $movie->id) }}'">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </button>
                                        <form action="{{ route('technicien.destroy', $schedule->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cette diffusion ?')">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        @if(Auth::user()->hasRole('administrateur'))
            <div>
                <h2>Gestion des utilisateurs</h2>
                <div class="container2">
                    <!-- Formulaire de gestion des utilisateurs -->
                    <section class="form-section">
                        <h2>Ajouter un utilisateur</h2>
                        <form action="{{ route('admin.store-user') }}" method="POST">
                            @csrf
                            <div>
                                <label for="nom">Nom :</label>
                                <input type="text" name="nom" id="nom" required>
                            </div>
                            <div>
                                <label for="email">Email :</label>
                                <input type="email" name="email" id="email" required>
                            </div>
                            <div>
                                <label for="password">Mot de passe :</label>
                                <input type="password" name="password" id="password" required>
                            </div>
                            <div>
                                <label for="role">Rôle :</label>
                                <select name="role" id="role" required>
                                    <option value="producteur">Producteur</option>
                                    <option value="jury">Jury</option>
                                    <option value="inspecteur">Inspecteur</option>
                                    <option value="visiteur">Visiteur</option>
                                    <option value="presidentjury">Président du jury</option>
                                    <option value="administrateur">Administrateur</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Ajouter l'utilisateur</button>
                        </form>
                    </section>
                </div>
                <div class="container3">
                    <!-- Liste des utilisateurs -->
                    <section class="form-section">
                        <h2>Liste des utilisateurs</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Rôle</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->nom }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ ucfirst($user->role) }}</td>
                                        <td>
                                            <!-- Modifier le rôle -->
                                            <form action="{{ route('admin.update-user', $user->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PUT')
                                                <select name="role">
                                                    <option value="producteur" {{ $user->role == 'producteur' ? 'selected' : '' }}>Producteur</option>
                                                    <option value="jury" {{ $user->role == 'jury' ? 'selected' : '' }}>Jury</option>
                                                    <option value="presidentjury" {{ $user->role == 'presidentjury' ? 'selected' : '' }}>President du jury</option>
                                                    <option value="inspecteur" {{ $user->role == 'inspecteur' ? 'selected' : '' }}>Inspecteur</option>
                                                    <option value="visiteur" {{ $user->role == 'visiteur' ? 'selected' : '' }}>Visiteur</option>
                                                    <option value="administrateur" {{ $user->role == 'administrateur' ? 'selected' : '' }}>Administrateur</option>
                                                    
                                                </select>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button>
                                            </form>

                                            <!-- Supprimer l'utilisateur -->
                                            <form action="{{ route('admin.delete-user', $user->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?')">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        @endif

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