<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa', // default role
            'status' => 'aktif', // default status
        ]);

        Auth::login($user);

        // Set up session data seperti di LoginController
        session([
            'login' => true,
            'user_id' => $user->id_user,
            'username' => $user->nama,
            'role' => $user->role,
        ]);

        return redirect()->route('mahasiswa.complete_profile')->with('success', 'Registrasi berhasil! Silakan lengkapi profil Anda.');
    }
}
