<?php

namespace App\Http\Controllers\AdminProdi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $admin_prodi = $user->prodi;
        return view('admin_prodi.profile', compact('user', 'admin_prodi'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'nullable|email|unique:users,email,' . Auth::id() . ',id_user',
            'prodi' => 'required'
        ]);

        $user = Auth::user();
        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'prodi' => $request->prodi
        ]);

        // Update session
        session(['nama' => $request->nama, 'prodi' => $request->prodi]);

        return redirect()->route('admin_prodi.profile')->with('msg', 'Profil berhasil diperbarui!')->with('msg_type', 'success');
    }
}
