<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show the login page
    public function showLogin()
    {
        return view('login');
    }

    // Process the login attempt
    public function login(Request $request)
    {
        // Validate the incoming data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to log in
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect to dashboard on success
            return redirect()->intended('/dashboard');
        }

        // If it fails, send them back with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Process logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // Show the registration page
    public function showRegister()
    {
        return view('register');
    }

   public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Auto-generate a Registration Number
        $regNumber = 'GF-' . date('Y') . '-' . rand(1000, 9999);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'student',
            'reg_number' => $regNumber,
        ]);

        Auth::login($user);

        return redirect('/dashboard')->with('success', "Account created! Your Registration Number is: {$regNumber}");
    }
}
