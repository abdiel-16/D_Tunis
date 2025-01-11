<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Diffusions</title>
    <link href="{{ asset('css/technicien.dashboard.css') }}" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <h1>Programmer une diffusion</h1>
        <form action="{{ route('technicien.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="movie_id" class="form-label">Film</label><br>
                <select name="movie_id" id="movie_id" class="form-control" required>
                    @foreach ($movies as $movie)
                        <option value="{{ $movie->id }}">{{ $movie->titre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="salle" class="form-label">Salle</label><br>
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
                            <a href="{{ route('technicien.edit', $schedule->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                            <form action="{{ route('technicien.destroy', $schedule->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cette diffusion ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
        

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
