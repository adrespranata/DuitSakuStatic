<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        $title = 'Duit Saku';
        return view('auth.login', compact('title'));
    }

    public function auth(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'The password field is required.',
        ]);
    
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Login successfully');
        } else {
            return redirect()->back()->with('error', 'Invalid email or password')->withInput();
        }
    }
    

    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            return redirect()->route('login')->with('success', 'Logout successful');
        } else {
            return redirect()->route('login')->with('error', 'You are not logged in.');
        }
    }

}
