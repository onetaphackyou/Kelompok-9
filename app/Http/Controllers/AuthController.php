<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->status !== 'aktif') {
                Auth::logout();
                return back()->with('error', 'Akun Anda tidak aktif');
            }

            // Update last login
            $user->update(['last_login' => now()]);

            // Set additional session data
            session([
                'login' => true,
                'user_id' => $user->getAuthIdentifier(),
                'role' => $user->role,
                'nama' => $user->nama,
                'prodi' => $user->prodi
            ]);

            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Email atau password salah');
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login');
    }
}

