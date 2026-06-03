<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use App\Models\KelasPerkuliahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengumumanController extends Controller
{
    public function index($id_kelas)
    {
        $dosen = Auth::user()->dosen;
        $kelas = KelasPerkuliahan::where('id_kelas', $id_kelas)
                    ->where('id_dosen', $dosen->id_dosen)
                    ->firstOrFail();

        $pengumuman = Pengumuman::where('id_kelas', $id_kelas)
                        ->orderByDesc('created_at')
                        ->get();

        return view('dosen.pengumuman', compact('kelas', 'pengumuman', 'id_kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        $dosen = Auth::user()->dosen;

        Pengumuman::create([
            'id_kelas' => $request->id_kelas,
            'id_dosen' => $dosen->id_dosen,
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        return redirect()->route('dosen.pengumuman', $request->id_kelas)
            ->with('success', 'Pengumuman berhasil ditambahkan!');
    }

    public function destroy($id_pengumuman)
    {
        $pengumuman = Pengumuman::findOrFail($id_pengumuman);
        $id_kelas = $pengumuman->id_kelas;
        $pengumuman->delete();

        return redirect()->route('dosen.pengumuman', $id_kelas)
            ->with('success', 'Pengumuman berhasil dihapus!');
    }
}