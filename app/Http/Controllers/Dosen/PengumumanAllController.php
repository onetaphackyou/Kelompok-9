<?php
namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use App\Models\KelasPerkuliahan;
use Illuminate\Support\Facades\Auth;

class PengumumanAllController extends Controller
{
    public function index()
    {
        $id_dosen = Auth::user()->dosen->id_dosen;

        $kelas_list = KelasPerkuliahan::where('id_dosen', $id_dosen)
            ->with('mataKuliah')
            ->get();

        $pengumuman_list = Pengumuman::whereIn('id_kelas', $kelas_list->pluck('id_kelas'))
            ->with('kelas.mataKuliah')
            ->orderByDesc('created_at')
            ->get();

        return view('dosen.pengumuman_all', compact('pengumuman_list', 'kelas_list'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'id_kelas' => 'required',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        Pengumuman::create([
            'id_kelas' => $request->id_kelas,
            'id_dosen' => Auth::user()->dosen->id_dosen,
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        return redirect()->route('dosen.pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan!');
    }

    public function destroy($id_pengumuman)
    {
        $pengumuman = Pengumuman::findOrFail($id_pengumuman);
        $pengumuman->delete();
        return redirect()->route('dosen.pengumuman.index')->with('success', 'Pengumuman berhasil dihapus!');
    }
}