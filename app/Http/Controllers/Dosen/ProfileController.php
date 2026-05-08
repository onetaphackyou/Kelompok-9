<?php
namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $dosen = Auth::user()->dosen;
        return view('dosen.profile', compact('dosen'));
    }

    public function update(Request $request)
    {
        $dosen = Auth::user()->dosen;
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'prodi' => 'required',
            'agama' => 'required',
            'jenis_jabatan' => 'required',
        ]);

        $dosen->update($request->only(['nama', 'nip', 'jenis_kelamin', 'prodi', 'agama', 'jenis_jabatan']));

        return redirect()->route('dosen.profile')->with('success', 'Profil berhasil diperbarui');
    }
}
