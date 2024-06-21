<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function loginForm()
    {
        return view('auth.login');
    }

    function registerForm()
    {
        return view('auth.register');
    }

    function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Regenerate the session to prevent session fixation attacks
            $request->session()->regenerate();

            // Save user credentials in the session
            $request->session()->put('username', $request->input('username'));
            $request->session()->put('role', Auth::user()->role);

            // Redirect based on user role
            if (Auth::user()->role === 2) {
                return redirect()->intended('/home/');
            }
            if (Auth::user()->role === 1) {
                return redirect()->intended('/home/');
            }
            if (Auth::user()->role === 3) {
                Auth::logout();
                return back()->withErrors([
                    'username' => 'Your account has been blocked.',
                ])->onlyInput('username');
            }
        }

        // If authentication fails, return back with an error message
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);

    }

    function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Registration successful. Please login.');
    }

    function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
