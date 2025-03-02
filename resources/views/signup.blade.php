<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    @vite(['resources/css/app.css'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gradient-to-br from-indigo-500 to-purple-600">

    <div class="max-w-md w-full bg-white shadow-lg rounded-2xl p-8">

        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Créer un compte</h2>
        <p class="text-center text-gray-500 mb-4">Rejoignez-nous dès maintenant !</p>

        <!-- Message de succès -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded-lg mb-4 text-sm">
                ✅ {{ session('success') }}
            </div>
        @endif

        <!-- Formulaire d'inscription -->
        <form action="{{ url('/subscribe') }}" method="POST">
            @csrf

            <!-- Nom -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-600">Nom</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition" 
                       placeholder="John Doe" required>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" 
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition" 
                       placeholder="you@example.com" required>
            </div>

            <!-- Mot de passe -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-600">Mot de passe</label>
                <input type="password" name="password" id="password" 
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition" 
                       required>
            </div>

            <!-- Bouton d'inscription -->
            <button type="submit" 
                    class="w-full bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition shadow-md">
                S'inscrire
            </button>
        </form>

        <!-- Lien de désinscription -->
        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">Déjà inscrit ? 
                <a href="{{route('sign_in_screen')}}" class="text-indigo-600 hover:underline font-medium">Se connecter</a>
            </p>
        </div>
    </div>

</body>
</html>
