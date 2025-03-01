<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) { 
            return redirect()->intended('dashboard');
        }
 
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
            'email' => $request->email,
            'password' => Hash::make($request->newPassword)
        ]);
        // Store subscription logic (e.g., save to the database or external API)
        // Here, we're just returning a success message for simplicity
        return redirect()->route('sign_in_screen')->with('success', 'You have successfully subscribed!');
    }
}
