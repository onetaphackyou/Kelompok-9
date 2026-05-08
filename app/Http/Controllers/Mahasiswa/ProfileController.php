<?php
namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $mhs = Auth::user()->mahasiswa;
        return view('mahasiswa.profile', compact('mhs'));
    }

    public function update(Request $request)
    {
        $mhs = Auth::user()->mahasiswa;

        $request->validate([
            'nama' => 'required|string',
            'nim' => 'required|string|unique:mahasiswa,nim,'.$mhs->id_mhs.',id_mhs',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'nullable|string',
            'prodi' => 'nullable|string',
            'periode' => 'nullable|string',
        ]);

        $mhs->update($request->only(['nama','nim','tempat_lahir','tanggal_lahir','jenis_kelamin','agama','prodi','periode']));

        return redirect()->route('mahasiswa.profile')->with('success', 'Profil berhasil diperbarui');
    }
}
