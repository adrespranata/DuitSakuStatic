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

        $title = 'Activity Based Costing';
        $subTitle = 'Login';
        return view('auth.login', compact('title', 'subTitle'));
    }

    public function auth(Request $request)
    {
        // Validasi data yang dikirimkan
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('login')->withErrors([
            'failed' => 'Email atau password yang Anda masukkan salah.'
        ])->withInput();
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect()->route('login')->with('success', 'Logout successful');
        } else {
            return redirect()->route('login')->with('error', 'You are not logged in.');
        }
    }
}
