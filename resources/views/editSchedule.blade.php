<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la diffusion</title>
    <link href="{{ asset('css/editSchedule.css') }}" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <h1>Modifier la diffusion</h1>
        <form action="{{ route('technicien.update', $schedule->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="movie_id" class="form-label">Film</label><br>
                <select name="movie_id" id="movie_id" class="form-control" required>
                    @foreach ($movies as $movie)
                        <option value="{{ $movie->id }}" {{ $movie->id == $schedule->movie_id ? 'selected' : '' }}>{{ $movie->titre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="salle" class="form-label">Salle</label><br>
                <input type="text" name="salle" id="salle" class="form-control" value="{{ $schedule->salle }}" required>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Date de la diffusion</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ $schedule->date }}" required>
            </div>

            <div class="mb-3">
                <label for="start_time" class="form-label">Heure de début</label>
                <input type="time" name="start_time" id="start_time" class="form-control" value="{{ $schedule->start_time }}" required>
            </div>

            <div class="mb-3">
                <label for="end_time" class="form-label">Heure de fin</label>
                <input type="time" name="end_time" id="end_time" class="form-control" value="{{ $schedule->end_time }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            <a href="{{ route('parametres') }}" class="btn btn-secondary">Annuler</a>
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

</body>
</html>
