<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire d'envoi d'Email</title>
</head>
<body>
    <div>
        <h1>Envoyer un Email</h1>

        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        <form action="{{ route('send.mail') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="email">Email du destinateur:</label>
                <input type="email" name="email" id="email" required>
            </div><br>
            <div>
                <label for="message">Message:</label>
                <textarea name="message" id="message" rows="4" required></textarea>
            </div><br>
             <div>
                <label for="attachment">Pièce jointe:</label>
                <input type="file" name="attachment" id="attachment" required>
            </div><br>

            <button type="submit">Envoyer</button>

        </form>

    </div>
</body>
</html>