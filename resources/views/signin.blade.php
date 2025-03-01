<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    @vite(entrypoints: 'resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="max-w-sm w-full bg-white shadow-md rounded-lg p-8">
        <h2 class="text-2xl font-bold text-center mb-6">Sign In</h2>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="bg-red-500 text-white p-3 rounded-lg mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Sign-in Form -->
        <form action="{{ route('login') }}" method="POST">
            @csrf <!-- {{ csrf_field() }} -->

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-600">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="you@example.com" required>
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <!-- Remember Me Checkbox -->
            <div class="mb-6">
                <label for="remember" class="inline-flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="form-checkbox text-indigo-600">
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <!-- Sign In Button -->
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Sign In
            </button>
        </form>

        <!-- Forgot Password Link -->
        <div class="mt-4 text-center">
            <a href="#" class="text-sm text-indigo-600 hover:underline">Forgot your password?</a>
        </div>

        <!-- Register Link -->
        <div class="mt-2 text-center">
            <p class="text-sm text-gray-600">Don't have an account? <a href="{{ route('signup') }}" class="text-indigo-600 hover:underline">Sign up</a></p>
        </div>
    </div>

</body>
</html>
