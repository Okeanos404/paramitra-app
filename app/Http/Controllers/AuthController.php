<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = Auth::user()->role;
            
            if ($role === 'admin') {
                return redirect()->intended('admin/dashboard')->with('success', 'Berhasil Login!');
            } elseif ($role === 'manajemen') {
                return redirect()->intended('manajemen/dashboard')->with('success', 'Berhasil Login!');
            } else {
                return redirect()->intended('customer/dashboard')->with('success', 'Berhasil Login!');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
