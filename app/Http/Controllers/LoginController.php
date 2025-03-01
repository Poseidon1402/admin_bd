<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
    // Validate incoming request
    $credentials = $credentials = $request->only('email', 'password');

    // Attempt authentication with session persistence
    if (Auth::attempt($credentials, true)) {
        // Regenerate session for security
        $request->session()->regenerate();
        
        // Redirect to the intended page or default dashboard
        return redirect()->route('virements_list');
    }

    // If authentication fails, return back with an error message
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
    }

    public function subscribe()
    {
        return view('signup');
    }

    public function store(Request $request)
    {
        // Validate the email
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => ['required'],
        ]);

        DB::table('users')->insert([
            'num_compte' => (string) Str::Uuid(),
            'nom' => $request->name,
            'email' => $request->email,
            'solde' => 60000,
            'password' => Hash::make($request->password)
        ]);
        // Store subscription logic (e.g., save to the database or external API)
        // Here, we're just returning a success message for simplicity
        return redirect()->route('sign_in_screen')->with('success', 'You have successfully subscribed!');
    }
}
