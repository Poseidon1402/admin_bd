<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    @vite(['resources/css/app.css'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gradient-to-br from-indigo-500 to-purple-600">

    <div class="max-w-sm w-full bg-white shadow-lg rounded-2xl p-8">
    
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Bienvenue</h2>
        <p class="text-center text-gray-500 mb-4">Se connecter à votre compte</p>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="bg-red-500 text-white p-3 rounded-lg mb-4 text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>⚠ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Sign-in Form -->
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" 
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-700 transition" 
                       placeholder="you@example.com" required>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-600">Mot de passe</label>
                <input type="password" name="password" id="password" 
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-700 transition" 
                       required>
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex justify-between items-center mb-6">
                <label for="remember" class="flex items-center text-sm text-gray-600">
                    <input type="checkbox" name="remember" id="remember" class="form-checkbox text-indigo-600">
                    <span class="ml-2">Se souvenir</span>
                </label>
                <a href="#" class="text-sm text-indigo-600 hover:underline">Mot de passe oublié ?</a>
            </div>

            <!-- Sign In Button -->
            <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition shadow-md">
                Se connecter
            </button>
        </form>

        <!-- Register Link -->
        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">Pas de compte ? 
                <a href="{{ route('signup') }}" class="text-indigo-600 hover:underline font-medium">S'inscrire</a>
            </p>
        </div>
    </div>

</body>
</html>
