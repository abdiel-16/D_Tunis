<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Film</title>
    <!-- Lien vers le fichier CSS séparé -->
    <link href="{{ asset('css/edit.css') }}" rel="stylesheet">
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <h1 class="jj">Modifier le Film</h1>

        <form action="{{ route('movies.update', $movie->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Utiliser PUT pour la mise à jour -->

            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" name="titre" value="{{ old('titre', $movie->titre) }}" required>
            </div>

            <div class="form-group">
                <label for="synopsis">Synopsis</label>
                <textarea name="synopsis" required>{{ old('synopsis', $movie->synopsis) }}</textarea>
            </div>

            <div class="form-group">
                <label for="duree">Durée</label>
                <input type="number" name="duree" value="{{ old('duree', $movie->duree) }}" required>
            </div>

            <div class="form-group">
                <label for="date_sortie">Date de sortie</label>
                <input type="date" name="date_sortie" value="{{ old('date_sortie', $movie->date_sortie) }}" required>
            </div>

            <button type="submit">Modifier le film</button>
        </form>
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

    <!-- Lien vers Bootstrap JS et Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
