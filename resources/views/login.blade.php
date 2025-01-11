<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="container">
        <h1>Connexion</h1>

        <form action="{{ route('connexion.submit') }}" method="POST">
            @csrf
            <div class="champ">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                @error('email')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class= "champ">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
                @error('password')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="button2">
                <button type="submit">Se connecter</button>
            </div>
        </form>
    </div>



</body>
</html>