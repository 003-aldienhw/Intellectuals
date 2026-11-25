<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return Auth::user()->role === 'petugas'
                ? redirect()->route('staff.home')
                : redirect()->route('member.home');
        }

        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt(['name' => $credentials['name'], 'password' => $credentials['password']])) {
            $user = Auth::user();

            $request->session()->regenerate();

            return $user->role === 'petugas'
                ? redirect()->intended(route('staff.home'))
                : redirect()->intended(route('member.home'));
        }

        return back()->withErrors([
            'name' => 'Nama atau password tidak sesuai.',
        ])->onlyInput('name');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}