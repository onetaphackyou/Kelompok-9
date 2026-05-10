<?php
namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function completeProfile()
    {
        // Jika user sudah memiliki data mahasiswa, redirect ke dashboard
        if (Auth::user()->mahasiswa) {
            return redirect()->route('mahasiswa.dashboard');
        }

        return view('mahasiswa.complete_profile');
    }

    public function storeCompleteProfile(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|unique:mahasiswa,nim',
            'nama' => 'required|string',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'nullable|string',
            'prodi' => 'nullable|string',
            'periode' => 'nullable|string',
        ]);

        $user = Auth::user();

        // Buat record mahasiswa
        Mahasiswa::create([
            'id_user' => $user->id_user,
            'nim' => $request->nim,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'prodi' => $request->prodi,
            'periode' => $request->periode,
        ]);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Profil berhasil dilengkapi!');
    }

    public function edit()
    {
        // Jika user belum memiliki data mahasiswa, redirect ke complete profile
        if (!Auth::user()->mahasiswa) {
            return redirect()->route('mahasiswa.complete_profile');
        }

        $mhs = Auth::user()->mahasiswa;
        return view('mahasiswa.profile', compact('mhs'));
    }

    public function update(Request $request)
    {
        $mhs = Auth::user()->mahasiswa;
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|string',
            'nim' => 'required|string|unique:mahasiswa,nim,'.$mhs->id_mhs.',id_mhs',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'nullable|string',
            'prodi' => 'nullable|string',
            'periode' => 'nullable|string',
            'email' => 'nullable|email|unique:users,email,' . $user->id_user . ',id_user',
        ]);

        $mhs->update($request->only(['nama','nim','tempat_lahir','tanggal_lahir','jenis_kelamin','agama','prodi','periode']));
        $user->update(['email' => $request->email]);

        return redirect()->route('mahasiswa.profile')->with('success', 'Profil berhasil diperbarui');
    }
}
