<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Producteur</title>
    <link href="{{ asset('css/producteur.dashboard.css') }}" rel="stylesheet">
</head>
<body>
    

    <div class="container1">
        <!-- Vue d'ensemble des films -->
        <section>
            <h2>Vue d'ensemble des films</h2>
            <table>
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Genres</th>
                        <th>Durée</th>
                        <th>Date de sortie</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movies as $movie)
                        <tr>
                            <td>{{ $movie->titre }}</td>
                            <td>
                                @foreach ($movie->genres as $genre)
                                    <span class="badge">{{ $genre->nom }}</span>
                                @endforeach
                            </td>
                            <td>{{ $movie->duree }} minutes</td>
                            <td>{{ $movie->date_sortie }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>
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
                                <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning">Modifier</a>
                                <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
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
